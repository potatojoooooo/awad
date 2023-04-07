<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = DB::table('bookings')->get();
        return view('bookings', ['bookings' => $bookings]);
    }
}
