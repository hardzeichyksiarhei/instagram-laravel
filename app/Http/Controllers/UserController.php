<?php

namespace App\Http\Controllers;

use Hash;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function changePassword(Request $request){
    $validatedData = $request->validate([
      'current-password' => 'required',
      'new-password' => 'required|string|min:6|confirmed',
    ]);

    if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
        // The passwords matches
        return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
    }
    if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
        //Current password and new password are same
        return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
    }
    
    //Change Password
    $user = Auth::user();
    $user->password = bcrypt($request->get('new-password'));
    $user->save();
    return redirect()->back()->with("success","Password changed successfully !");
  }
}
