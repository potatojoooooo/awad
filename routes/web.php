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
use App\Http\Controllers\BookingController;

//HomePage
Route::get('/home', function(){
    return view('home');
})->name('home');

Auth::routes();
//Show admin login form
Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm'])->name('login.admin');
//Post admin login details
Route::post('/login/admin', [LoginController::class, 'adminLogin']);

//Show user login form
Route::get('/login/user', [LoginController::class, 'showUserLoginForm'])->name('login.user');
//Post user login details
Route::post('/login/user', [LoginController::class, 'userLogin']);

//Show admin register form
Route::get('/register/admin', [RegisterController::class, 'showAdminRegisterForm']);
//Post admin register details
Route::post('/register/admin', [RegisterController::class, 'createAdmin']);

//Show admin register form
Route::get('/register/user', [RegisterController::class, 'showUserRegisterForm']);
//Post user register details
Route::post('/register/user', [RegisterController::class, 'createUser']);

//Verify and view admin in authenticated
Route::group(['middleware' => 'auth:admin'], function () {
    Route::view('/admin', 'admin');
});

//Verify and view user is authenticated
Route::group(['middleware' => 'auth:user'], function () {
    Route::view('/user', 'user');
});

//Services
Route::get("services",[ServiceController::class, 'getServices']);
//View Services
Route::view('services','services')->name('services');

//Display booking
Route::get("displayBooking",[BookingController::class, 'getBookings']);

//Update booking
Route::get("updateBooking/{id}",[BookingController::class,'ShowUpdate']);
Route::post("updateBooking/{id}",[BookingController::class,'updateBooking']);

//About us
Route::view("aboutus","aboutUs")->name('aboutus');

//Contact us
Route::view("contactus","contactUs")->name('contactus');

//After login as user will show this page
Route::view("user","user");

//Log out function

Route::get('logout', [LoginController::class, 'logout']);

