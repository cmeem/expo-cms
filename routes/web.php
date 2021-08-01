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

// public routes goes here
Route::middleware('web')->group(function(){
    Route::get('/', [App\Http\Controllers\GuestController::class, 'index'])->name('homepage');
    Route::get('/{staticPage}', [App\Http\Controllers\GuestController::class, 'showStaticPages'])
            ->where('staticPage',strtolower(config('settings.static_pages','About|Contact-us|Terms|Conditions')))->name('static.pages');
    // Route::get('/{slag}', [App\Http\Controllers\GuestController::class, 'index'])->name('homepage');


});

// // auth users routes goes here
// Route::prefix(env('APP_NAME'))->middleware('auth:web')->group(function(){
//     Route::get('/profile', [App\Http\Controllers\UserController::class, 'index'])->name('user.account');
//     Route::get('/settings', [App\Http\Controllers\UserController::class, 'index'])->name('user.account');


// });
