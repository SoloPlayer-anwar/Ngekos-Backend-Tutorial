<?php

use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCotroller;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::group(['middleware' => ['auth', 'admin']], function(){
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::view('template', 'layouts.bootstrap');
Route::resource('users', UserController::class);
Route::resource('kota', KotaController::class);
Route::resource('fasilitas', FasilitasController::class);
Route::resource('mitra', MitraController::class);
Route::resource('product', ProductController::class);
});
