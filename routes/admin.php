<?php


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::prefix(env('APP_NAME'))->group(function(){

//login routes
Route::get('/login',[App\Http\Controllers\Backend\Auth\AdminLoginController::class,'showLoginForm'])->name('admin.login.form');
Route::post('/login',[App\Http\Controllers\Backend\Auth\AdminLoginController::class,'login'])->name('admin.login.attempt');

//reset password routes
Route::post('/password/email',[App\Http\Controllers\Backend\Auth\AdminForgotPasswordController::class,'sendResetLinkEmail'])->name('admin.password.email');
Route::get('/password/reset',[App\Http\Controllers\Backend\Auth\AdminForgotPasswordController::class,'showLinkRequestForm'])->name('admin.password.request');
Route::post('/password/reset',[App\Http\Controllers\Backend\Auth\AdminResetPasswordController::class,'reset'])->name('admin.password.update');
Route::get('/password/reset/{email}/{token}',[App\Http\Controllers\Backend\Auth\AdminResetPasswordController::class,'showResetForm'])->name('admin.password.reset');

//logout route
Route::get('/logout',[App\Http\Controllers\Backend\Auth\AdminLoginController::class,'logout'])->name('admin.logout');

});

Route::prefix(env('APP_NAME'))->middleware('auth:admin')->group(function(){
//application backend routes
Route::get('/',App\Http\Controllers\Backend\Dashboard::class)->name('admin.dashboard');
//posts routes
Route::get('/posts',App\Http\Controllers\Backend\Posts::class)->name('admin.posts');
Route::get('/posts/create',App\Http\Controllers\Backend\CreatePost::class)->name('admin.posts.create');
Route::get('/posts/{post}/edit',App\Http\Controllers\Backend\EditPost::class)->name('admin.posts.edit');
Route::get('/posts/{post}/view',App\Http\Controllers\Backend\ViewPost::class)->name('admin.posts.view');
// comments, categories and archive routes
Route::get('/comments',App\Http\Controllers\Backend\Comment::class)->name('admin.comments');
Route::get('/categories',App\Http\Controllers\Backend\Categories::class)->name('admin.categories');
Route::get('/archive',App\Http\Controllers\Backend\Archive::class)->name('admin.archive');
//settings routes
Route::get('/seo',App\Http\Controllers\Backend\Settings\Seo::class)->name('admin.seo');
Route::get('/profile',App\Http\Controllers\Backend\Settings\Profile::class)->name('admin.profile');

});

