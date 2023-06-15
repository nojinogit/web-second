<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReserveRequest;
use App\Models\Reserve;

class ReserveController extends Controller
{
    public function reserveAdd(ReserveRequest $request){

        $reserve=$request->only(['user_id','shop_id','date','time','hc']);
        Reserve::create($reserve);
        return redirect('/thanksReserve');
    }

    public function reserveDelete(Request $request){

        Reserve::find($request->id)->delete();
        return redirect('/myPage');
    }

    public function reserveUpdate(ReserveRequest $request){

        $reserve=$request->only(['date','time','hc']);
        Reserve::find($request->id)->update($reserve);
        return redirect('/myPage');
    }
}
