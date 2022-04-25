<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeadController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth.user');
    }

    public function leads(){
        return view('leads.list');
    }
}
