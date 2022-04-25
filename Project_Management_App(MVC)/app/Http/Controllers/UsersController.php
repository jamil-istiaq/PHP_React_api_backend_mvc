<?php

namespace App\Http\Controllers;

use App\Models\UserInfoModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth.user');
    }

    public function user(){
        $usr=UserInfoModel::all();
        return view('user.list')
        ->with('usr',$usr);
    }

    public function createuser(){
        return view('user.create');
    }

    public function cnfmuser(Request $rq){
        
        $usr=new UserModel();
        $usr->name=$rq->name;
        $usr->email=$rq->email;
        $usr->password=$rq->password;
        $usr->phone=$rq->phone;
        $usr->address=$rq->address;
        $usr->positions=$rq->positions;
        $usr->save();

        $deleteData = UserInfoModel::where('id','=',$rq->id)
        ->first();
        $deleteData->delete();

        return redirect()->route('user');
        
    }

    public function delete(Request $rq){
        
        $deleteData = UserInfoModel::where('id','=',$rq->id)

        ->first();

        $deleteData->delete();

        return redirect()->route('user');  
    }

    public function usersubmit(Request $rq){
        $this->validate($rq,
    [
        'name'=>'required',
        'email'=>'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
        'password'=>'required',
        'phone'=>'required|min:11|max:14',
        'address'=>'required',
        'role'=>'required'
        
    ]
    );
    $usr=new UserModel();
    $usr->name=$rq->name;
    $usr->email=$rq->email;
    $usr->password=md5($rq->password);
    $usr->phone=$rq->phone;
    $usr->address=$rq->address;
    $usr->positions=$rq->role;
    $usr->save();
   
    return redirect()->route('validuser');


    }

    public function validuser(){
        $usr=UserModel::all();
        return view('user.validuser')
        ->with('usr',$usr);
    }

    public function useredit($id){
        
        $s= UserModel::where('id','=',$id)
        ->first();
        
        return view('user.details')
        ->with('s',$s);
    }

    public function usereditSubmit(Request $rq){
        $this->validate($rq,
        [
            'name'=>'required',
            'email'=>'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password'=>'required',
            'phone'=>'required|min:11|max:14',
            'address'=>'required',
            'positions'=>'required',
            
        ]
        );
        $usr= UserModel::where('id','=',$rq->id)
        ->first();

        $usr->name=$rq->name;
        $usr->email=$rq->email;
        $usr->phone=$rq->phone;
        $usr->address=$rq->address;
        $usr->positions=$rq->role;
        $usr->save();
       
        return redirect()->route('validuser');
        // return $rq;
    }

    public function deleteuser($id){
        
        $deleteData = UserModel::where('id','=',$id)

        ->first();

        $deleteData->delete();

        return redirect()->route('validuser');  
    }

}
