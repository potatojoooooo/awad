<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

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

    public function showUpdate($id)
    {   
        $booking = Booking::find($id);
        $booking->time = Carbon::parse($booking->time)->format('H:i');
        $services = Service::all();
        return view("booking.updateBooking", ['booking'=>$booking, 'services'=>$services]);
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
        
        $booking->date = $req->date;
        $booking->time = Carbon::createFromFormat('H:i:s', $req->time.':00');
        $booking->serviceID = $req->serviceID;
        $booking->save();
        // return redirect("displayBooking");
        dd($req->all());
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



//     protected function createBooking(Request $request)
//     {
//         $validator = $this->validateBooking($request->all());

//         if ($validator->fails()) {
//             return redirect()->back()->withErrors($validator)->withInput();
//         }

//         Booking::create([
//             'date' => $request->date,
//             'time' => $request->time,
//             'serviceID' => $request->serviceID,
//             'name' => $request->name,
//             'phone' => $request->phone,
//         ]);
//     }
// }