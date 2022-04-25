<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth.user');
    }

    public function message(){
        return view('message.create');
    }

    public function SendMessage(Request $rq){
        $this->validate($rq,
        [
            'rcver'=>'required',
            'message'=>'required',
        ]
        );
        
        $msg= new Message();
        //$msg->sender_id=$rq->sender_id;
        $msg->receiver=$rq->rcver;
        $msg->message=$rq->message;
        //$msg->attachment=$rq->file;
       // $msg->save();
       $data = array(
        
        'message'   =>   $rq->message
    );
       Mail::to($rq->rcver)->send(new SendMail($data));
        return redirect()->route('notifications');

    }

    public function notifications(){
        
        $messages= Message::all();
        return view('notification.list')->with('messages',$messages);
    }

}
