<?php

use App\Http\Controllers\HeadAPIController;
use App\Http\Controllers\HomeAPIController;
use App\Http\Controllers\LoginAPIController;
use App\Http\Controllers\MessageAPIController;
use App\Http\Controllers\NotificationAPIController;
use App\Http\Controllers\ProjectAPIController;
use App\Http\Controllers\TaskAPIController;
use App\Http\Controllers\UserAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//home counts api's
Route::get('/gethead',[HeadAPIController::class,'GetHead']);
Route::get('/user.count',[HomeAPIController::class,'GetUserCount']);
Route::get('/project.count',[HomeAPIController::class,'GetProjectCount']);
Route::get('/task.count',[HomeAPIController::class,'GetTaskCount']);
Route::get('/pending.count',[HomeAPIController::class,'GetPending']);

//user
Route::get('/all.user',[UserAPIController::class,'getuser']);
Route::get('/all.user/{id}',[UserAPIController::class,'getOneUser']);
Route::post('/user.add',[UserAPIController::class,'usersubmit']);
Route::post('/user.confirm/{id}',[UserAPIController::class,'cnfmuser']);
Route::get('/user/delete/{id}',[UserAPIController::class,'deleteuser']);
Route::get('/valid.user',[UserAPIController::class,'validuser']);
Route::post('/user.edit',[UserAPIController::class,'usereditSubmit']);

//user login & signup
Route::post('/user.signup',[LoginAPIController::class,'signupsubmit']);
Route::post('/user.login',[LoginAPIController::class,'loginsubmit']);
Route::get('/getprofile/{id}',[LoginAPIController::class,'Getprofile']);

//mail/message
Route::post('/sendMsg',[MessageAPIController::class,'SendMessage']);

//notifications
Route::get('/notifications/all',[NotificationAPIController::class,'notifications']);
Route::get('/notifications/delete/{id}',[NotificationAPIController::class,'delete']);

//project
Route::get('/project/all',[ProjectAPIController::class,'getall']);
Route::get('/project/member',[ProjectAPIController::class,'CreateProject']);
Route::post('/project/creat',[ProjectAPIController::class,'SubmitProject']);
Route::get('/project/open',[ProjectAPIController::class,'GetOpenProject']);
Route::get('/project/modify',[ProjectAPIController::class,'Modproject']);
Route::get('/project/delete/{id}',[ProjectAPIController::class,'deleteProject']);
Route::post('/project/modify/submit',[ProjectAPIController::class,'ModSubmit']);

//task
Route::get('/openproject/names',[TaskAPIController::class,'createtask']);
Route::post('/task/create',[TaskAPIController::class,'submitTask']);
Route::get('/task/assign',[TaskAPIController::class,'AssignTask']);
Route::get('/task/{id}',[TaskAPIController::class,'taskGet']);
Route::post('/task/submit',[TaskAPIController::class,'TaskSubmit']);
Route::get('/task/delete/{id}',[TaskAPIController::class,'deletetask']);