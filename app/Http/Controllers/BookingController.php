<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function getBookings()
    {
        if (Auth::guard('web')->check()) {
            $user = Auth::user();
            $bookings = Booking::where('bookings.userID', $user->id)
                ->orderBy('id', 'asc')
                ->with('services')
                ->get();
            return view('booking.displayBooking', ['bookings' => $bookings]);
        } else {
            return redirect()->route('login');
        }
    }

    public function showUpdate($id)
    {
        $booking = Booking::find($id);
        $services = Service::all();
        return view("booking.updateBooking", ['booking' => $booking, 'services' => $services]);
    }

    public function updateBooking(Request $req)
    {
        $validatedData = $req->validate([
            'date' => 'required|after:today',
            'time' => 'required|after:08:59|before:17:01', //must between 9am to 5pm
            'services' => 'required|array',
            'services.*' => 'exists:services,id',
        ], [
            'date.after' => 'The new date must be tommorrow or a future date.',
        ]);

        $booking = Booking::find($req->id);
        $booking->date = $validatedData['date'];
        $booking->time = $validatedData['time'];

        $services = Service::whereIn('id', $validatedData['services'])->get();
        $booking->services()->sync($services);
        $booking->save();
        return redirect()->route('booking.displayBooking')->with('updateSuccess', 'Booking updated successfully');
    }

    public function deleteBooking($id)
    {
        $booking_id = Booking::find($id)
            ->delete();
        $booking_id = DB::table('booking_services')
            ->where('booking_id', '=', $id)

            ->delete();
        return redirect("displayBooking")->with('deleteSuccess', 'Booking deleted successfully');
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
        return redirect()->route('booking.displayBooking')->with('bookSuccess', 'Booking has been made.');;
    }

    protected function getServices()
    {
        $services = DB::table('services')->get();
        return view('booking.createBooking', ['services' => $services]);
    }

    public function index()
    {
        $bookings = Booking::all();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        return view('bookings.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date',
        ]);

        $booking = Booking::create($validatedData);

        return redirect('/bookings');
    }

    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        return view('bookings.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date',
        ]);

        $booking->update($validatedData);

        return redirect('/bookings/' . $booking->id);
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect('/bookings');
    }
}
