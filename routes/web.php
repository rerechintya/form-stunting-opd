<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiskominfoController;
use App\Http\Controllers\DisdikController;
use App\Http\Controllers\DinkesController;
use App\Http\Controllers\DinsosController;


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

Route::get('/', function() {
    return view('pages.index');
});

Route::prefix('form')->group(function() {
    Route::get('/diskominfo', [DiskominfoController::class, 'index']);
    Route::post('/diskominfo/submit', [DiskominfoController::class, 'store']);

    Route::get('/disdik', [DisdikController::class, 'index']);
    Route::post('/disdik/submit', [DisdikController::class, 'store']);

    Route::get('/dinkes', [DinkesController::class, 'index']);
    Route::post('/dinkes/submit', [DinkesController::class, 'store']);
    
    Route::get('/dinsos', [DinsosController::class, 'index']);
    Route::post('/dinsos/submit', [DinsosController::class, 'store']);

    Route::get('/disdik/{date}', [DisdikController::class, 'edit']);
    Route::post('/disdik/update', [DisdikController::class, 'update']);

    Route::get('/diskominfo/{date}', [DiskominfoController::class, 'edit']);
    Route::post('/diskominfo/update', [DiskominfoController::class, 'update']);

    Route::get('/dinsos/{date}', [DinsosController::class, 'edit']);
    Route::post('/dinsos/update', [DinsosController::class, 'update']);


});
