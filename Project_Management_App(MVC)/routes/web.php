<?php

use App\Http\Controllers\HeadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;


Route::get('/',[LoginController::class,'login'])->name('login');
Route::post('/login',[LoginController::class,'loginsubmit'])->name('logged');

Route::get('/signup',[LoginController::class,'signup'])->name('signup');
Route::post('/signup',[LoginController::class,'signupsubmit'])->name('signup');

Route::get('/home',[HomeController::class,'dashboard'])->name('home');

Route::get('/user',[UsersController::class,'user'])->name('user');
Route::post('/user',[UsersController::class,'usersubmit'])->name('user');

Route::post('/confirm',[UsersController::class,'cnfmuser'])->name('confirm');
Route::get('/reject/{id}',[UsersController::class,'delete'])->name('reject');

Route::get('/createuser',[UsersController::class,'createuser'])->name('createuser');
Route::post('/createuser',[UsersController::class,'usersubmit'])->name('createuser');

Route::get('/validuser',[UsersController::class,'validuser'])->name('validuser');

Route::get('/edit/{id}',[UsersController::class,'useredit'])->name('edit');
Route::post('/edit/{id}',[UsersController::class,'usereditSubmit'])->name('update');


Route::get('/deleteuser/{id}',[UsersController::class,'deleteuser'])->name('deleteuser');

Route::get('/message',[MessageController::class,'message'])->name('message');
Route::post('/message',[MessageController::class,'SendMessage'])->name('sendmessage');

Route::get('/messages',[MessageController::class,'notifications'])->name('notifications');

Route::get('/create.project',[ProjectController::class,'CreateProject'])->name('create.project');
Route::post('/create.project',[ProjectController::class,'SubmitProject'])->name('create.project');
Route::get('/open.project',[ProjectController::class,'openproject'])->name('open.project');

Route::get('/modify/{id}',[ProjectController::class,'Modprojecte'])->name('modify');
Route::post('/modify/{id}',[ProjectController::class,'ModSubmit'])->name('modifySubmit');

Route::get('/create.task',[TasksController::class,'createTask'])->name('create.task');
Route::post('/create.task',[TasksController::class,'submitTask'])->name('submit.task');
Route::get('/open.task',[TasksController::class,'AssignTask'])->name('assign.task');

Route::get('/submit/{id}',[TasksController::class,'taskGet'])->name('taskget');
Route::post('/submit/{id}',[TasksController::class,'TaskSubmit'])->name('finishtask');

Route::get('/profile',[LoginController::class,'profile'])->name('profile');
Route::post('/profile',[LoginController::class,'EditProfile'])->name('EditProfile');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
