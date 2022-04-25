<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HeadController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth.user');
    }

    public function heads(){
        return view('heads.list');
    }
}
