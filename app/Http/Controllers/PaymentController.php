<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;
use App\Models\Setting;

class PaymentController extends Controller
{
    private $_api_context;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

      /** PayPal api context **/
      //$paypal_conf = \Config::get('paypal');
      $setting = Setting::find(1);
      $this->_api_context = new ApiContext(new OAuthTokenCredential(
          //$paypal_conf['client_id'],
          //$paypal_conf['secret'])
          $setting->paypal_client_id,
          $setting->paypal_secret
      ));
      //$this->_api_context->setConfig($paypal_conf['settings']);
      $this->_api_context->setConfig([
        'mode' => $setting->sandbox,
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'ERROR'
      ]);
    }

    public function payWithpaypal(Request $request)
    {
      $validatedData = $request->validate([
        'amount' => 'required|numeric',
      ]);

      $payer = new Payer();

      $payer->setPaymentMethod('paypal');

      $item_1 = new Item();

      $item_1->setName('Item 1') /** item name **/
          ->setCurrency('RUB')
          ->setQuantity(1)
          ->setPrice($request->get('amount')); /** unit price **/

      $item_list = new ItemList();

      $item_list->setItems(array($item_1));

      $amount = new Amount();

      $amount->setCurrency('RUB')
          ->setTotal($request->get('amount'));

      $transaction = new Transaction();

      $transaction->setAmount($amount)
          ->setItemList($item_list)
          ->setDescription('Your transaction description');

      $redirect_urls = new RedirectUrls();

      $redirect_urls->setReturnUrl(URL::to('status')) /** Specify return URL **/
          ->setCancelUrl(URL::to('status'));

      $payment = new Payment();

      $payment->setIntent('Sale')
          ->setPayer($payer)
          ->setRedirectUrls($redirect_urls)
          ->setTransactions(array($transaction));
      /** dd($payment->create($this->_api_context));exit; **/

      try {
          $payment->create($this->_api_context);
      } catch (\PayPal\Exception\PPConnectionException $ex) {
          if (\Config::get('app.debug')) {
              \Session::put('error', 'Connection timeout');
              return Redirect::to('/');
          } else {
              \Session::put('error', 'Some error occur, sorry for inconvenient');
              return Redirect::to('/');
          }
      }

      foreach ($payment->getLinks() as $link) {
          if ($link->getRel() == 'approval_url') {
              $redirect_url = $link->getHref();
              break;
          }
      }

      /** add payment ID to session **/
      Session::put('paypal_payment_id', $payment->getId());
      if (isset($redirect_url)) {
          /** redirect to paypal **/
          return Redirect::away($redirect_url);
      }
      
      \Session::put('error', 'Unknown error occurred');
      return Redirect::to('/');
    }

    public function getPaymentStatus(Request $request)
    {
      /** Get the payment ID before session clear **/
      $payment_id = Session::get('paypal_payment_id');
      /** clear the session payment ID **/
      Session::forget('paypal_payment_id');
      if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
          \Session::put('error', __('Payment failed'));
          return Redirect::to('/recharge');
      }
      $payment = Payment::get($payment_id, $this->_api_context);
      $execution = new PaymentExecution();
      $execution->setPayerId(Input::get('PayerID'));
      /**Execute the payment **/
      $result = $payment->execute($execution, $this->_api_context);
      if ($result->getState() == 'approved') {

        $amount = $result->getTransactions()[0]->amount->total;
        $request->user()->addCredits($amount);

        \Session::put('success', __('Payment success'));
        return Redirect::to('/recharge');
      }
      \Session::put('error', __('Payment failed'));
      return Redirect::to('/recharge');
    }
}