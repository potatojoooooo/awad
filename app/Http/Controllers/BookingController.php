<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = DB::table('bookings')->get();
        return view('bookings', ['bookings' => $bookings]);
    }

    public function showUpdate($id)
    {   
        $booking = Booking::find($id);
        $dateOnly = new Carbon($booking->date);
        $booking->date = $dateOnly->toDateString(); 
        $booking->time = Carbon::parse($booking->time)->format('H:i');
        return view("booking.updateBooking", ['booking'=>$booking]);
    }

    public function updateBooking(Request $req)
    {
        $req->validate([
            'date' => 'required|after:yesterday',
            'time' => 'required',
            'serviceID' => 'required',      
        ]);

        $booking = Booking::find($req->id);
        
        // Combine the date and time into a datetime object
        $datetime = Carbon::createFromFormat('Y-m-d H:i:s', $req->date.' '.$req->time.':00');
        $booking->date = $datetime;
        $booking->time = $datetime;
        $booking->serviceID = $req->serviceID;
        $booking->save();
        return redirect("displayBooking");
    }
}
