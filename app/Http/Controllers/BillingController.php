<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillingController extends Controller
{
  public function index(Request $request) {
    $billing = \App\Models\User::find($request->user()->id)->billings;
    return view('billing', ['billings' => $billing]);
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'payment_system' => 'required',
      'amount' => 'required|numeric|min:1000',
      'score' => 'required'
    ]);

    $user = $request->user();

    if ($user->balans - $request->get('amount') < 0) {
        // The passwords matches
        return redirect()->back()->with("error", __('Insufficient funds'));
    }

    $user->balans = $user->balans - $request->get('amount');
    $user->save();
    
    $billing = $user->billings()->create([
      'payment_system' => $request->get('payment_system'),
      'amount' => $request->get('amount'),
      'score' => $request->get('score')
    ]);

    if ($billing)
      return redirect()->back()->with("success", __('Your application for withdrawal funds successfully accepted! Wait...'));
    else
      return redirect()->back()->with("error", __('Something went wrong!'));
  }
}
