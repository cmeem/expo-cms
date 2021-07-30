<?php

use Illuminate\Support\Facades\Auth;
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




Auth::routes();
Route::get('/social-login/{serviceProvider}/redirect', [App\Http\Controllers\Auth\LoginController::class,'redirectToProvider'])->name('social.login');
Route::get('/social-login/{serviceProvider}/callback', [App\Http\Controllers\Auth\LoginController::class,'handleProviderCallback'] );
Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('homepage');
