<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Booking;
use Carbon\Carbon;

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
