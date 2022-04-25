<?php

namespace App\Http\Controllers;

use App\Models\UserInfoModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class UserAPIController extends Controller
{
    public function getOneUser($id){
        $usr=UserInfoModel::where('id','=',$id)
        ->first();
        return response()->json($usr, 200);
    }

    public function getuser(){
        $usr=UserInfoModel::all();
        return response()->json($usr, 200);
    }

    public function cnfmuser(Request $rq){
        try{
        $usr=new UserModel();
        $usr->name=$rq->name;
        $usr->email=$rq->email;
        $usr->password=$rq->password;
        $usr->phone=$rq->phone;
        $usr->address=$rq->address;
        $usr->positions=$rq->positions;
        if($usr->save()){
            $deleteData = UserInfoModel::where('id','=',$rq->id)
            ->first();
            $deleteData->delete();
            return response()->json(["msg" => "Confirm Successfully"], 200);
        }
    }
    catch (\Exception $ex) {
        return response()->json(["msg" => "Could not Processed"], 500);
    }
}

public function delete(Request $rq){
        
    $deleteData = UserInfoModel::where('id','=',$rq->id)

    ->first();

    $deleteData->delete();

    return response()->json(["msg" => "Confirm Successfully"], 200);
}     

public function usersubmit(Request $rq){
    $this->validate($rq,
[
    'name'=>'required',
    'email'=>'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
    'password'=>'required',
    'phone'=>'required|min:11|max:14',
    'address'=>'required',
    
    
]
);
try{
$usr=new UserModel();
$usr->name=$rq->name;
$usr->email=$rq->email;
$usr->password=md5($rq->password);
$usr->phone=$rq->phone;
$usr->address=$rq->address;
$usr->positions=$rq->role;
if($usr->save()){
    return response()->json(["msg" => "Submit Successfully"], 200);  
}
}
catch (\Exception $ex) {
    return response()->json(["msg" => "Could not Processed"], 500);
}
}
 
public function validuser(){
    $usr=UserModel::all();
    return response()->json($usr, 200);
}    
public function useredit($id){
        
    $s= UserModel::where('id','=',$id)
    ->first();
    
    return response()->json($s, 200);
    
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
    try{
    $usr->name=$rq->name;
    $usr->email=$rq->email;
    $usr->phone=$rq->phone;
    $usr->address=$rq->address;
    $usr->positions=$rq->role;
    if($usr->save()){
        return response()->json(["msg" => "Submit Successfully"], 200);  
    }
}
    catch (\Exception $ex) {
        return response()->json(["msg" => "Could not Processed"], 500);
    }
    }

    public function deleteuser($id){
        
        $deleteData = UserModel::where('id','=',$id)

        ->first();

        $deleteData->delete();

        return response()->json(["msg" => "Delete Successfully"], 200);
    }

}
