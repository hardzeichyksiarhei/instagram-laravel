<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;

use GuzzleHttp\Client;

class OrderController extends Controller
{
  public function index(Request $request) {
    $orders = $request->user()->orders()->where('status', '!=', 'Completed')->get();

    $api_key = Setting::find(1)->nakrutka_api_key;

    $client = new Client();

    $orders->each(function ($item, $key) use ($api_key, $client) {
      $order = $item->cheat_order;

      $res = $client->request('GET', 'https://smm.nakrutka.by/api/?key=' . $api_key . '&action=status&order=' . $order);

      $status = json_decode($res->getBody());
      
      if ($status->status !== $item->status) {
        $item->update([
          'status' => $status->status
        ]);
      }

    });

    return view('all-orders', [
      'orders' => $request->user()->orders
    ]);
  }

  public function store(Request $request) {

    $validatedData = $request->validate([
      'cheat_name' => 'required',
      'cheat_id' => 'required|numeric',
      'count' => 'required|numeric|between:' . $request->min . ',' . $request->max,
      'link' => 'required|string',
      'price' => 'required|numeric',
    ], [
      'between' => [
        'numeric' => 'Количество должно быть между :min и :max.'
      ]
    ]);

    $client = new Client();

    $api_key = Setting::find(1)->nakrutka_api_key;

    $cheat_name = $request->cheat_name;
    $cheat_id = $request->cheat_id;
    $count = $request->count;
    $link = $request->link;
    $price = $request->price;

    $res = $client->request('GET', 'https://smm.nakrutka.by/api/?key=' . $api_key . '&action=create&service=' . $cheat_id . '&quantity=' . $count . '&link=' . $link);

    $response = json_decode($res->getBody());
    
    if (property_exists($response, 'Error')) {
      return redirect()->back()->with("error", $response->Error);
    }

    if ($request->user()->balans < $price) {
      return redirect()->back()->with("error", 'Недостаточно средств!');
    }

    $order = $response->order;

    $res = $client->request('GET', 'https://smm.nakrutka.by/api/?key=' . $api_key . '&action=status&order=' . $order);

    $status = json_decode($res->getBody());

    if (property_exists($status, 'Error')) {
      return redirect()->back()->with("error", $status->Error);
    }

    // create order

    $request->user()->orders()->create([
      'cheat_name' => $request->cheat_name,
      'cheat_order' => $order,
      'count' => $request->count,
      'link' => $request->link,
      'price' => $request->price,
      'status' => $status->status,
    ]);

    // minus credits

    $request->user()->minusCredits($request->price);

    // Referral

    $user_id = $request->user()->id;

    $referral = \App\ReferralRelationship::whereUserId($user_id)->first();

    if ($referral) {
      if ($link = $referral->referralLink) {
        if ($user = $link->user) {
          if ($user_id != $referral->id) {

            $setting = Setting::find(1);

            $referral_discount = $setting ? $setting->referral_discount : 5.00;

            $credit = $request->price * $referral_discount / 100; 

            $user->addCredits($credit);
            $referral->addReferralCredits($credit);
            
          }
        }
      }
    }

    return redirect()->back()->with("success","Заказ прошел успешно!");

  }
}
