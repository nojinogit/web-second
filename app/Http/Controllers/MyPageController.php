<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserve;
use Illuminate\Support\Facades\Auth;
use \Carbon\Carbon;

class MyPageController extends Controller
{
    public function myPage(Request $request){
        $reserves=Reserve::with('user','shop')->orderBy('date', 'asc')->where('user_id','=',Auth::user()->id)->where('date','>',Carbon::yesterday())->get();
        return view('/mypage',compact('reserves'));
    }
}
