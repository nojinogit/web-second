<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function favoriteStore(Request $request){

        $favorite=$request->only(['user_id','shop_id']);
        Favorite::create($favorite);
        return redirect('/');
    }

    public function favoriteDelete(Request $request){
        
        Favorite::where('user_id',$request->user_id)->where('shop_id',$request->shop_id)->delete();
        return redirect('/');
    }

    public function favoriteDeleteMyPage(Request $request){
        
        Favorite::where('user_id',$request->user_id)->where('shop_id',$request->shop_id)->delete();
        return redirect('/myPage');
    }
}
