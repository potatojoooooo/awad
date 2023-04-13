<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;


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
use App\Http\Controllers\UserController;

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
Route::get('/register/admin', [RegisterController::class, 'showAdminRegisterForm'])->name('register.admin');
//Post admin register details
Route::post('/register/admin', [RegisterController::class, 'createAdmin']);

//Show admin register form
Route::get('/register/user', [RegisterController::class, 'showUserRegisterForm'])->name('register.user');
//Post user register details
Route::post('/register/user', [RegisterController::class, 'createUser']);

//Admin
Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('/home/admin/{id}', function () {
        return view('home');
    })->name('home.admin');
    Route::get('/admin/profile/{id}', [ProfileController::class, 'getAdmin'])->name('profile.admin');
    Route::get('/services/admin/{id}', [ServiceController::class, 'displayService'])->name('services.admin');
    Route::get('/updateService/{id}', [ServiceController::class, 'updateService'])->name('services.update');
    Route::get('/deleteService/{id}', [ServiceController::class, 'deleteService'])->name('services.delete');
    Route::get('/showBooking', [BookingController::class, 'view'])->name('booking.admin');
    Route::get('/editBooking{id}', [BookingController::class, 'edit']);
    Route::post('/editBooking{id}', [BookingController::class, 'showEdit'])->name('booking.editBooking');
    Route::delete('/removeBooking/{id}', [BookingController::class, 'delete'])->name('booking.delete');
});

//User
Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/home/user/{id}', function () {
        return view('home');
    })->name('home.user');
    Route::get('/user/profile/{id}', [ProfileController::class, 'getUser'])->name('profile.user');
    Route::get('/services/user/{id}', [ServiceController::class, 'getServices'])->name('services.user');
    Route::get('/displayBooking', [BookingController::class, 'getBookings'])->name('booking.user');
    Route::get('/createBooking', [BookingController::class, 'getServices'])->name('booking.createBooking');
    Route::post('/createBooking', [BookingController::class, 'createBooking']);
    Route::get('/updateBooking/{id}', [BookingController::class, 'ShowUpdate']);
    Route::post('/updateBooking/{id}', [BookingController::class, 'updateBooking'])->name('booking.updateBooking');
    Route::get('/deleteBooking/{id}', [BookingController::class, 'deleteBooking'])->name('booking.deleteBooking');
});

//About us
Route::view("aboutus", "aboutUs")->name('aboutus');

//Contact us
Route::view("contactus", "contactUs")->name('contactus');

//Log out function
Route::get('logout', [LoginController::class, 'logout']);

//Delete user profile
Route::post('/delete/user/profile', [ProfileController::class, 'deleteUser'])->name('delete.user');

//Delete admin profile
Route::post('/delete/admin/profile', [ProfileController::class, 'deleteAdmin'])->name('delete.admin');

Route::get('/services', [ServiceController::class, 'getServices'])->name('services');

//Policy
Gate::policy(User::class, UserModelPolicy::class);
Gate::policy(Service::class, ServiceModelPolicy::class);
Gate::policy(Booking::class, BookingModelPolicy::class);
