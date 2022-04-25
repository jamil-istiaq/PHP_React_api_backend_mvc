<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class NotificationAPIController extends Controller
{
    //
    public function notifications(){
        
        $messages= Message::all();
        return response()->json($messages,200);
        
    }

    public function delete($id){
        
        $messages= Message::where('id','=',$id);
        return response()->json($messages,200);
        
    }
}
