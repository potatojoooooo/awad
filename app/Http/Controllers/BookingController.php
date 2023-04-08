<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function getBookings()
    {
        $bookings = DB::table('bookings')
            ->join('services', 'bookings.serviceID', '=', 'services.id')
            ->select('bookings.*', 'services.name')
            ->get();
        return view('booking.displayBooking', ['bookings' => $bookings]);
    }
}
