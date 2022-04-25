<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageAPIController extends Controller
{
    public function SendMessage(Request $rq){
        $this->validate($rq,
        [
            'rcver'=>'required',
            'message'=>'required',
        ]
        );
        
        $msg= new Message();
        $msg->sender_id=$rq->sender_id;
        $msg->receiver=$rq->rcver;
        $msg->message=$rq->message;
        $msg->attachment=$rq->file;
        $msg->save();
       
        return response()->json(["msg" => "Message Send Successfully"], 200)->route('notifications');
    }

   
}
