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
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;

//HomePage
Route::get('/', function () {
    return view('home');
})->name('home');

//Show login and register option
Route::view('loginRegister', 'loginRegister')->name('loginRegister');

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
Route::get('/register/user', [RegisterController::class, 'showUserRegisterForm'])->name('register.user');
//Post user register details
Route::post('/register/user', [RegisterController::class, 'createUser']);

// Verify and view admin is authenticated
Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('/admin/home', function () {
        return view('home');
    })->name('admin.home');
});

Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/user/home', function () {
        return view('home');
    })->name('user.home');
});

// Routes for user profile
Route::middleware(['auth'])->group(function () {
    Route::get('/user/profile', [ProfileController::class, 'getUser'])->name('profile.user');
});

// Routes for admin profile
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/profile', [ProfileController::class, 'getAdmin'])->name('profile.admin');
});

//Services
Route::get('/services', [ServiceController::class, 'getServices'])->name('services');

//Display booking
Route::get("displayBooking", [BookingController::class, 'getBookings'])->name('booking.displayBooking');

//Create booking
Route::get("createBooking", [BookingController::class, 'getServices'])->name('booking.createBooking');
Route::post("createBooking", [BookingController::class, 'createBooking']);

//Update booking
//Route::view("updateBooking", "booking.updateBooking")->name('booking.updateBooking');
Route::get("updateBooking/{id}", [BookingController::class, 'ShowUpdate']);
Route::post("updateBooking/{id}", [BookingController::class, 'updateBooking'])->name('booking.updateBooking');

//Delete booking
Route::get('deleteBooking/{id}',[BookingController::class,'deleteBooking'])->name('booking.deleteBooking');


//About us
Route::view("aboutus", "aboutUs")->name('aboutus');

//Contact us
Route::view("contactus", "contactUs")->name('contactus');

//Log out function
Route::get('logout', [LoginController::class, 'logout']);
