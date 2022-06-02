<?php

use App\Http\Controllers\API\FasilitasController;
use App\Http\Controllers\API\KotaController;
use App\Http\Controllers\API\MitraController;
use App\Http\Controllers\API\ProductKosController;
use App\Http\Controllers\API\userController;
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

Route::middleware('auth:sanctum')->group(function(){
    Route::get('user', [userController::class, 'getUser']);
    Route::post('logout', [userController::class, 'logout']);
    Route::post('update', [userController::class, 'updateUser']);
    Route::post('avatar', [userController::class, 'uploadAvatar']);
});


Route::post('register', [userController::class, 'register']);
Route::post('login', [userController::class, 'login']);
Route::post('mitra', [MitraController::class, 'mitra']);

Route::get('fasilitas', [FasilitasController::class, 'fasilitas']);
Route::get('kota', [KotaController::class, 'kota']);
Route::get('product', [ProductKosController::class, 'product']);
