<?php

use App\Http\Controllers\API\PantiController;
use App\Http\Controllers\API\KegiatanController;
use App\Http\Controllers\API\DonasiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [AuthController::class, 'register'])->name('user.register');
Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum')->name('user.logout');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum')->name('user.me');


Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('panti', PantiController::class,['except'=>'update']);
    Route::match(['PUT','PATCH'],'panti',[PantiController::class,'update'])->name('panti.update');
    Route::apiResource('donasi', DonasiController::class,['except'=>'update']);
    Route::match(['PUT','PATCH'],'donasi',[DonasiController::class,'update'])->name('donasi.update');
    Route::apiResource('kegiatan', KegiatanController::class);
});
