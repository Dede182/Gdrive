<?php

use App\Http\Controllers\api\ApiUserController;
use App\Http\Controllers\Api\auth\AuthController;
use App\Http\Controllers\api\BulkActionController;
use App\Http\Controllers\Api\file\ApiFileController;
use App\Http\Controllers\api\folder\ApiFolderController;
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
    // files
    Route::get('/files',[ApiFileController::class,'files']);
    Route::post('/files/create',[ApiFileController::class,'create']);

    // folders
    Route::get('/folders',[ApiFolderController::class,'folders']);
    Route::post('/folders/create',[ApiFolderController::class,'create']);
    Route::get('/folders/show/{folder}',[ApiFolderController::class,'show']);

    // bulk actions
    Route::post('/bulkCopy',[BulkActionController::class,'bulkCopy']);
    Route::post('/bulkDelete',[BulkActionController::class,'bulkDelete']);
    Route::post('/download',[BulkActionController::class,'download']);


    Route::get('/user',[ApiUserController::class,'user']);
});
Route::prefix('v1')->group(function(){
    Route::post('/register',[AuthController::class,'register'])->name('api.register');
    Route::post('/login',[AuthController::class,'login'])->name('api.login');
});
