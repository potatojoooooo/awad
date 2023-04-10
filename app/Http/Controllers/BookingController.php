<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use Carbon\Carbon;
use App\Models\Service;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function getBookings()
    {
        $user = Auth::user();
        session(['user_id' => $user->id]);
        $bookings = Booking::where('bookings.userID', $user->id)
            ->orderBy('id', 'asc')
            ->with('services')
            ->get();
        
        return view('booking.displayBooking', ['bookings' => $bookings]);
    }

    public function getAllBookings()
    {
        $admin = Auth::admin();
        session(['admin_id' => $admin->id]);
        $bookings = Booking::orderBy('id', 'asc')
            ->with('services')
            ->get();
        
        return view('booking.displayBooking', ['bookings' => $bookings]);
    }

    public function showUpdate($id)
    {
        $booking = Booking::find($id);
        $dateOnly = new Carbon($booking->date);
        $booking->date = $dateOnly->toDateString();
        $booking->time = Carbon::parse($booking->time)->format('H:i');
        return view("booking.updateBooking", ['booking' => $booking]);
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
        $datetime = Carbon::createFromFormat('Y-m-d H:i:s', $req->date . ' ' . $req->time . ':00');
        $booking->date = $datetime;
        $booking->time = $datetime;
        $booking->serviceID = $req->serviceID;
        $booking->save();
        return redirect("displayBooking");
    }

    public function deleteBooking($id)
    {
        $booking_id = Booking::find($id);
        echo "$booking_id";
        $booking_id -> delete();
        return redirect("displayBooking")->with('success', 'Booking deleted successfully');
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
            'date' => ['required'],
            'time' => ['required'],
            'serviceID' => ['required'],
        ]);
    }

    protected function createBooking(Request $req)
    {
        // Validate the user input
        $validatedData = $req->validate([
            'date' => 'required|date|after:today',
            'time' => 'required|after:08:59|before:17:01',
            'services' => 'required|array',
            'services.*' => 'exists:services,id',
        ]);
        $user = Auth::user();
        session(['user_id' => $user->id]);
        // Create a new booking record and retrieve its id
        $booking = new Booking();
        $booking->userID = $user->id;
        $booking->date = $validatedData['date'];
        $booking->time = $validatedData['time'];
        $booking->save();
        $bookingId = $booking->id;

        // Associate the selected services with the new booking
        $services = Service::whereIn('id', $validatedData['services'])->get();
        $booking->services()->attach($services);

        // Redirect the user to the booking details page
        return redirect()->route('booking.displayBooking');
    }



    protected function getServices()
    {
        $services = DB::table('services')->get();
        return view('booking.createBooking', ['services' => $services]);
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
