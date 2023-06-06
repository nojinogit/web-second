<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class IndexController extends Controller
{
    public function index(Request $request){

    $stores=Store::all();
    return view('/index',compact('stores'));
    }
}
