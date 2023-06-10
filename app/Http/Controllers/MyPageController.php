<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserve;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    public function myPage(Request $request){
        $reserves=Reserve::with('user','shop')->where('user_id','=',Auth::user()->id)->get();
        return view('/mypage',compact('reserves'));
    }
}
