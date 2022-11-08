<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\GfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', function () {
    return view('welcome');
});


Route::middleware(['auth','verified'])->group(function(){
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::post('/folder/store',[FolderController::class,'store'])->name('folder.store');
    Route::post('/folder/upload',[FolderController::class,'folderUpload'])->name('folder.upload');
    Route::get("/folder/show/{folder}",[FolderController::class,'show'])->name('folder.show');
    Route::post('/file/store',[GfileController::class,'store'])->name('file.store');
    Route::delete('/bulkDelete',[GfileController::class,'bulkDelete'])->name('bulkDelete');
    Route::post('/bulkCopy',[GfileController::class,'bulkCopy'])->name('bulkCopy');
    Route::get('/download/{file}',[GfileController::class,'downloads'])->name('download');
    Route::get('/trash',[DashboardController::class,'trash'])->name('trash');
});

Route::get('/dia',[FolderController::class,'dia']);
require __DIR__.'/auth.php';
