<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SignupController;


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
    return view('index');
});

Route::get('single', function () {
    return view('single');
})->name('login');

Route::get('login', function () {
    return view('auth.login');
});

Route::get('register', function () {
    return view('auth.signup');
})->middleware('auth');;
Route::post('login',[LoginController::class,'save']);
Route::post('register',[SignupController::class,'save']);

Route::get('admin',[AdminController::class,'index'])->middleware('auth');
Route::get('admin/posts',[AdminController::class,'posts'])->middleware('auth');

Route::get('admin/posts/{type}',[AdminController::class,'posts'])->middleware('auth');
Route::post('admin/posts/{type}',[AdminController::class,'posts'])->middleware('auth');

Route::get('admin/posts/{type}/{id}',[AdminController::class,'posts'])->middleware('auth');
Route::post('admin/posts/{type}/{id}',[AdminController::class,'posts'])->middleware('auth');

Route::get('admin/categories',[AdminController::class,'categories'])->middleware('auth');
Route::get('admin/categories/{type}',[AdminController::class,'categories'])->middleware('auth');
Route::post('admin/categories/{type}',[AdminController::class,'categories'])->middleware('auth');
Route::get('admin/categories/{type}/{id}',[AdminController::class,'categories'])->middleware('auth');
Route::post('admin/categories/{type}/{id}',[AdminController::class,'categories'])->middleware('auth');
Route::get('admin/users',[AdminController::class,'users'])->middleware('auth');

