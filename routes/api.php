<?php

use App\Http\Controllers\Api\auth\AuthController;
use App\Http\Controllers\Api\file\ApiFileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('v1')->middleware('auth:sanctum')->group(function(){
    Route::post('/logout',[AuthController::class,'logout'])->name('api.logout');
    Route::get('/logoutAll',[AuthController::class,'logoutAll']);
    Route::get('/files',[ApiFileController::class,'files']);
});
Route::prefix('v1')->group(function(){
    Route::post('/register',[AuthController::class,'register'])->name('api.register');
    Route::post('/login',[AuthController::class,'login'])->name('api.login');
});
