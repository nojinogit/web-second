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
        return redirect('/myPage');
    }
}
