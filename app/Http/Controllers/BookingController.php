<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
<<<<<<< HEAD
use Illuminate\Support\Facades\Validator;
use App\Models\Booking;
=======
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
>>>>>>> 0f68dcadc10926692fa16e50d8dafafac3404f17

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

<<<<<<< HEAD
=======
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
            'date' => 'required|after:today', 
            'time' => 'required|after:08:59|before:17:01', //must between 9am to 5pm
            'serviceID' => 'required',      
        ], [
            'date.after' => 'The new date must be tommorrow or a future date.',
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
>>>>>>> 0f68dcadc10926692fa16e50d8dafafac3404f17
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
<<<<<<< HEAD
{
    return Validator::make($data, [
        'date' => ['required'],
        'time' => ['required'],
        'serviceID' => ['required'],
        'name' => ['required', 'string', 'max:2'],
        'phone' => ['required', 'string', 'regex:/^\d{10}$/'], 
    ]), 
=======
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

  
>>>>>>> 0f68dcadc10926692fa16e50d8dafafac3404f17
}



    protected function createBooking(Request $request)
    {
        $validator = $this->validateBooking($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Booking::create([
            'date' => $request->date,
            'time' => $request->time,
            'serviceID' => $request->serviceID,
            'name' => $request->name,
            'phone' => $request->phone,
        ]);
    }
}