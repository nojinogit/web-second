<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function managementIndex(Request $request){
    
    return view('/management');
    }
}
