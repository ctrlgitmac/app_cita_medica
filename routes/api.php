<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;


Route::resource('usuarios', AuthController::class);

Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);

Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware('auth:api')->group(function(){
    Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
});