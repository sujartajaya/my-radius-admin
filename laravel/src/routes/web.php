<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebloginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserhotspotController;

Route::get('/', [UserController::class,'index']);
Route::get('/home', [AdminController::class,'index']);
Route::get('/login', [UserController::class,'index']);
Route::get('/user/register',[UserController::class,'registeruser']);
Route::post('/user/register',[UserController::class,'store']);
Route::post('/login',[UserController::class,'authenticate']);


Route::prefix('/web')->group(function () {
    Route::get('/email',[WebloginController::class,'testloginmail']);
    Route::get('/api/test',[WebloginController::class,'testlogin']);
    Route::get('/api/users',[WebloginController::class,'getAllUsers']);
    Route::post('/api/logmail',[WebloginController::class,'loginemail']);
    //Route::post('/login',[WebloginController::class,'reqlogin']); /** login hotspot */
    Route::post('/login',[TestController::class,'loginv2']);

});

Route::middleware('auth')->group(function () {
    Route::post('/logout',[UserController::class,'actionlogout']);
});

// Route::middleware('admin')->prefix('/admin')->group(function () {
    
// });

// Route::middleware('operator')->prefix('/op')->group(function () {
    
// });

Route::post('/web/api/checkmember',[WebloginController::class,'checkMember']);

Route::post('/web/checkmem',[MemberController::class,'memberValidator']);

Route::post('/web/member',[MemberController::class,'store']);

Route::get('/web/members',[MemberController::class,'getMembers']);


Route::prefix('/test')->group(function () {
    Route::get('/tab1',[TestController::class,'index']);
    Route::get('/tab2',[TestController::class,'tab2']);
    Route::get('/tab3',[TestController::class,'tab3']);
    Route::get('/loginv2',[TestController::class,'loginv2']);
    Route::post('/loginv2',[TestController::class,'loginv2']);
    Route::get('/modal',[WebloginController::class,'viewModal']);
    Route::get('/users/{username}',[WebloginController::class,'showUser']);
    Route::get('/modal1', function () {
        return view('test.modal1');
    });

});

Route::prefix('/hotspot')->group(function () {
    Route::get('/users',[UserhotspotController::class,'index']);
    Route::post('/user',[UserhotspotController::class,'store']);
    Route::get('/login/user',[WebloginController::class,'getAllUsers']);
    Route::get('/user/create',[WebloginController::class,'create']);
});


