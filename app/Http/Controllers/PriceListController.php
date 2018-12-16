<?php

namespace App\Http\Controllers;

use App;
use App\Models\PriceList;
use Illuminate\Http\Request;

class PriceListController extends Controller
{
    public function index() {

      $locale = App::getLocale();

      $priceList = PriceList::where('locale', $locale)->get();

      if (!count($priceList)) $priceList = PriceList::where('locale', 'ru')->get();

      return view('price-list', ['pricelists' => $priceList]);
    }

    public function getViewCheatsByCategoryChaetId(Request $request, $category_cheat_id)
    {
      return PriceList::where('cheat_category_id', $category_cheat_id)->get();
    }
}
