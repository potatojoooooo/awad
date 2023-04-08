<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Booking;

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

    // public function processForm(Request $request)
    // {
    //     $selectedOptions = $request->input('selectedOptions');
    //     // return view('form', ['selectedOptions' => $selectedOptions]);
    //     
    // }

    // protected function validateBooking(array $data)
    // {
    //     return Validator::make($data, [
    //         'date' => 'required',
    //         'time' => 'required',
    //         'serviceID' => 'required',
    //         'name' => 'required|max:2',
    //         'phone' => 'required| max:2'
    //     ]);
    // }

    protected function validateBooking(array $data)
    {
        return Validator::make($data, [
            'date' => 'required',
            'time' => 'required',
            'serviceID' => 'required',
            'name' => 'required|max:2',
            'phone' => 'required|max:2'
        ], [
            'name.required' => 'Name is required.',
            'phone.required' => 'Phone is required.'
        ]);
    }

    protected function createBooking(array $data)
    {
        return Booking::create([
            'date' => $data['date'],
            'time' => $data['time'],
            'serviceId' => $data['serviceId'],
            'name' => $data['name'],
            'phone' => $data['phone'],

        ]);
    }
}
