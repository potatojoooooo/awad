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
            'date' => 'required | date',
            'time' => 'required',
            'serviceID' => 'required | integer',
            'name' => 'required|max:2',
            'phone' => 'required|max:2'
        ], [
            'name.required' => 'Name is required.',
            'phone.required' => 'Phone is required.'
        ]);
    }

    protected function createBooking(Request $request)
    {
        $this->validator($request->all())->validate();
        Booking::create([
            'date' => $request->date,
            'time' => $request->time,
            'serviceID' => $request->serviceID,
            'name' => $request->name,
            'phone' => $request->phone,

        ]);
        return redirect()->intended('login/admin');
    }

  
}
