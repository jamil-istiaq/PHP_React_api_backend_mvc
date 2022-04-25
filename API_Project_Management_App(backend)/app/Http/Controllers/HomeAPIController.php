<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\UserInfoModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class HomeAPIController extends Controller
{
    public function GetUserCount(){
        $user_count=UserModel::count();
        return response()->json([
            'status'=>'Success',
            'data'=>$user_count
            
        ]);
    }

    public function GetProjectCount(){
        $project_count=Project::count();
        return response()->json([
            'status'=>'Success',
            'data'=>$project_count
            
        ]);
    }

    public function GetTaskCount(){
        $task_count=Task::count();
        return response()->json([
            'status'=>'Success',
            'data'=>$task_count
            
        ]);
    }

    public function GetPending(){
        $pending_count=UserInfoModel::count();
        return response()->json([
            'status'=>'Success',
            'data'=>$pending_count
            
        ]);
    }

    public function logout(){
        return redirect()->route('login');
    }
}
