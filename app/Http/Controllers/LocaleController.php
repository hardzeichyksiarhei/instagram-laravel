<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
  public function index(Request $request, $locale) {
    if (in_array($locale, \Config::get('app.locales'))) {
      Session::put('locale', $locale);
    }
    return redirect()->back();
  }
}
