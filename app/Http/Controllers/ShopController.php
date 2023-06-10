<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class ShopController extends Controller
{
    public function index(Request $request){

    $shops=Shop::all();
    $areas=Shop::select('area')->distinct()->get();
    $categories=Shop::select('category')->distinct()->get();
    return view('/index',compact('shops','areas','categories'));
    }

    public function detail($id){
    $shop=Shop::find($id);
    return view('/detail',compact('shop'));
    }
}
