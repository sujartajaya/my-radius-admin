<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebloginController;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class,'index']);
Route::get('/web/login',[WebloginController::class,'index']); 
Route::get('/login', [UserController::class,'index']);

