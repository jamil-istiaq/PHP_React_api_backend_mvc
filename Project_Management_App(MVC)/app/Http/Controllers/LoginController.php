<?php

namespace App\Http\Controllers;

use App\Models\UserInfoModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function login(){
        return view('login.login');
    }

    public function loginsubmit(Request $rq){
        $this->validate($rq,
        [
            
            'email'=>'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password'=>'required',
            
        ]
        );

        $user=UserModel::where ('email',$rq->email)
        ->select('name','email','phone','id','positions')
        ->where ('password',md5($rq->password))
        ->first();

        

        if(!$user->positions=='User'){
            return $user;
        }
        elseif(!$user->positions=='Head'){
            return $user;
        }
        elseif(!$user->positions=='Lead'){
            return $user;
        }
        elseif($user->positions =='Admin'){
            $rq->session()->flash('msg','User exists');
            $rq->session()->put('admin',$user->name);
            $rq->session()->put('admail',$user->email);
            $rq->session()->put('adid',$user->id);

            return redirect()->route('home');
        }
        else{
        $rq->session()->flash('msg','User does not exists');
        $message="Wrong User";
        return view('login.login')->with('message',$message); 
        }

    
    }

    public function signup(){
        return view('login.signup');
    }

    public function signupsubmit(Request $rq){
        $this->validate($rq,
    [
        'name'=>'required',
        'email'=>'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
        'password'=>'required',
        'phone'=>'required|min:11|max:14',
        'address'=>'required',
        
    ]
    );
    $usr=new UserInfoModel();
    $usr->name=$rq->name;
    $usr->email=$rq->email;
    $usr->password=md5($rq->password);
    $usr->phone=$rq->phone;
    $usr->address=$rq->address;
    $usr->save();
   
    return redirect()->route('login');
    }

    public function profile(){
        $id=session()->get('adid');
        

        $profile= UserModel::where('id','=',$id)
        ->first();

        return view('admin.profile')->with('profile',$profile);

    }

    public function EditProfile(Request $rq){

    }

    public function logout(){
        session()->flush();
        return redirect()->route('login');
    }
}
