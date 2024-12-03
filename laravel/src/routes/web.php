<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebloginController;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class,'index']);
Route::post('/web/login',[WebloginController::class,'reqlogin']); 
Route::get('/login', [UserController::class,'index']);
Route::post('/web/api/logmail',[WebloginController::class,'loginemail']);
Route::get('/web/api/test',[WebloginController::class,'testlogin']);
Route::get('/web/email',[WebloginController::class,'testloginmail']);
Route::get('/user/register',[UserController::class,'registeruser']);
Route::post('/user/register',[UserController::class,'store']);
Route::post('/login',[UserController::class,'authenticate']);
Route::post('/logout',[UserController::class,'actionlogout']);



