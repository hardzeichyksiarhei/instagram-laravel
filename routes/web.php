<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes([ 'verify' => true ]);

Route::get('/', 'HomeController@index')->name('home');

Route::get('setlocale/{locale}', 'LocaleController@index')->name('setlocale');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::middleware(['auth', 'verified'])->group(function () {

  Route::get('user', function (Request $request) {
    return Auth::user();
  });

  Route::get('/price-list', 'PriceListController@index')->name('price');

  Route::get('/referral', function () {
    return view('referral');
  })->name('referral');

  Route::get('/recharge', function () {
    return view('recharge');
  })->name('recharge');

  Route::get('/exercise-cheat', function () {
    return view('exercise-cheat');
  })->name('exercise-cheat');

  Route::get('/orders', 'OrderController@index')->name('all-orders');
  Route::post('/order', 'OrderController@store')->name('order');

  Route::get('/cheat-category', 'CheatCategoryController@index');

  Route::get('/get-view-cheats-by-category-chaet-id/{category_cheat_id}', 'PriceListController@getViewCheatsByCategoryChaetId');

  Route::get('/account-settings', function () {
    return view('account-settings');
  })->name('account-settings');

  Route::get('/withdrawal-funds', function () {
    return view('withdrawal-funds', ['withdrawal_commission' => \App\Models\Setting::find(1)->withdrawal_commission]);
  })->name('withdrawal-funds');

  Route::get('/billing', 'BillingController@index')->name('billing');
  Route::post('/billing', 'BillingController@store')->name('store-billing');

  Route::post('/change-password','UserController@changePassword')->name('change-password');

  // route for processing payment
  Route::post('paypal', 'PaymentController@payWithpaypal')->name('paypal');

  // route for check status of the payment
  Route::get('/status', 'PaymentController@getPaymentStatus');
});
