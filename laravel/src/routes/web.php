<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebloginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TestController;

Route::get('/', [UserController::class,'index']);
Route::get('/home', [AdminController::class,'index']);
Route::get('/login', [UserController::class,'index']);
Route::get('/user/register',[UserController::class,'registeruser']);
Route::post('/user/register',[UserController::class,'store']);
Route::post('/login',[UserController::class,'authenticate']);
Route::get('/hotspot/users',[WebloginController::class,'getAllUsers']);
Route::get('/hotspot/user/create',[WebloginController::class,'create']);
Route::get('/modal',[WebloginController::class,'viewModal']);


Route::prefix('/web')->group(function () {
    Route::get('/email',[WebloginController::class,'testloginmail']);
    Route::get('/api/test',[WebloginController::class,'testlogin']);
    Route::get('/api/users',[WebloginController::class,'getAllUsers']);
    Route::post('/api/logmail',[WebloginController::class,'loginemail']);
    Route::post('/login',[WebloginController::class,'reqlogin']);
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
});
