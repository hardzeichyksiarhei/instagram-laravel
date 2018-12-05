<?php

namespace App\Http\Controllers;

use App;
use App\Models\PriceList;
use Illuminate\Http\Request;

class PriceListController extends Controller
{
    public function index() {

      $priceList = PriceList::where('locale', App::getLocale())->get();

      return view('price-list', ['pricelists' => $priceList]);
    }

    public function getViewCheatsByCategoryChaetId(Request $request, $category_cheat_id)
    {
      return PriceList::where('cheat_category_id', $category_cheat_id)->get();
    }
}
