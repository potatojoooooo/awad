<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ServiceController;

Route::get('/home', function () {
    return view('home');
})->name('home');

Auth::routes();
Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm'])->name('login.admin');
Route::get('/login/user', [LoginController::class, 'showUserLoginForm'])->name('login.user');
Route::get('/register/admin', [RegisterController::class, 'showAdminRegisterForm']);
Route::get('/register/user', [RegisterController::class, 'showUserRegisterForm']);
Route::post('/login/admin', [LoginController::class, 'adminLogin']);
Route::post('/login/user', [LoginController::class, 'userLogin']);
Route::post('/register/admin', [RegisterController::class, 'createAdmin']);
Route::post('/register/user', [RegisterController::class, 'createUser']);
Route::group(['middleware' => 'auth:admin'], function () {
    Route::view('/admin', 'admin');
});

Route::group(['middleware' => 'auth:user'], function () {
    Route::view('/user', 'user');
});

Route::view("displayBooking","booking.displayBooking");
Route::view("aboutus","aboutUs");
Route::view("contactus","contactUs");
Route::view("user","user");
Route::get("services",[ServiceController::class, 'index']);
Route::get('logout', [LoginController::class, 'logout']);
Route::view("/","home");
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
