<?php

namespace App\Http\Controllers;

use App\Models\CheatCategory;
use Illuminate\Http\Request;

class CheatCategoryController extends Controller
{
  public function index(Request $request)
  {
    return CheatCategory::all();
  }
}
