<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\User;

class AccountController extends Controller
{
    public function accountIndex(Request $request){
    
    return view('/account');
    }
}
