<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserve;
use App\Models\Shop;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use \Carbon\Carbon;

class MyPageController extends Controller
{
    public function myPage(Request $request){
        $reserves=Reserve::with('user','shop')->orderBy('date', 'asc')->where('user_id','=',Auth::user()->id)->where('date','>',Carbon::yesterday())->get();
        $shops = Favorite::with('shop')->where('user_id',Auth::user()->id)->get();
        //$shops　違う検索方法記録
        //$shops = Shop::whereIn('id', function($query) {
        //$query->select('shop_id')->from('favorites')->
        //where('user_id', Auth::user()->id);})->get();
        return view('/mypage',compact('reserves','shops'));
    }
}
