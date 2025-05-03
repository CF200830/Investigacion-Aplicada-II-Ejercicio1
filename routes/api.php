<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CuponController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('registro',[AuthController::class, 'registro']);
Route::post('login',[AuthController::class, 'login']);

Route::group(['middleware'=>'auth:sanctum'], function(){

    Route::put('/canje/{codigo_cupon}', [CuponController::class, 'canje']);
    Route::get('/cupon/{codigo_cupon}', [CuponController::class, 'show']);
    Route::post('logout',[AuthController::class, 'logout']);
});