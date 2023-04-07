<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::view('/', 'welcome');
Auth::routes();
Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);
Route::get('/register/admin', [RegisterController::class, 'showAdminRegisterForm']);
Route::post('/login/admin', [LoginController::class, 'adminLogin']);
Route::post('/register/admin', [RegisterController::class, 'createAdmin']);
Route::group(['middleware' => 'auth:admin'], function () {
    Route::view('/admin', 'admin');
});

Route::view("displayBooking","booking.displayBooking");
Route::view("aboutus","aboutUs");
Route::view("contactus","contactUs");
Route::get("services",[ServiceController::class, 'index']);
Route::get('logout', [LoginController::class, 'logout']);
Route::view("/","home");
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
