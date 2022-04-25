<?php

namespace App\Http\Controllers;

use App\Models\Head;
use Illuminate\Http\Request;

class HeadAPIController extends Controller
{
    //
    public function GetHead(){
       $data= Head::all(); 
       return response()->json($data,200);
    }
}
