<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Representative;
use App\Models\Shop;
use App\Models\Reserve;

class ManagementController extends Controller
{
    public function managementIndex(Request $request){

    $shops=Representative::with('shop')->where('user_id',Auth::user()->id)->get();
    return view('/management',compact('shops'));
    }

    public function shopUpdateArea(Request $request){

    $shopUpdate=Shop::find($request->id);
    $shops=Representative::with('shop')->where('user_id',Auth::user()->id)->get();
    return view('/management',compact('shopUpdate','shops'));
    }

    public function shopReserve(Request $request){
    $reserves=reserve::with('user','shop')->withTrashed()->where('shop_id',$request->id)->StartDateSearch($request->startDate)->EndDateSearch($request->endDate)->get();
    $shops=Representative::with('shop')->where('user_id',Auth::user()->id)->get();
    return view('/management',compact('reserves','shops'));
    }

    public function shopCreate(Request $request){
    $dir='sample';
    $image_name=$request->file('image')->getClientOriginalName();
    $request->file('image')->storeAs('public/'.$dir,$image_name);
    $shop=['name'=>$request->name,'area'=>$request->area,'category'=>$request->category,'overview'=>$request->overview,'image_name' => $image_name,'path' => 'storage/'.$dir.'/'.$image_name];
    Shop::create($shop);
    $shopId=Shop::latest('id')->first();
    Representative::create(['shop_id' => $shopId->id,'user_id' => Auth::user()->id]);
    return redirect('/managementIndex');
    }


}
