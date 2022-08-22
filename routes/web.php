<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiskominfoController;
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

    Route::get('/dinkes', [DinkesController::class, 'index']);
    Route::post('/dinkes/submit', [DinkesController::class, 'store']);
    
    Route::get('/dinsos', [DinsosController::class, 'index']);
    Route::post('/dinsos/submit', [DinsosController::class, 'store']);
});
