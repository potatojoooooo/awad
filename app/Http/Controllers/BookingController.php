<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Admin;
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
        return redirect()->route('booking.user')->with('updateSuccess', 'Booking updated successfully');
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
        $user_id = $user->id;
        session(['user_id' => $user_id]);
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
        return redirect()->route('booking.user', ['id' => $user_id]);
    }

    protected function getServices()
    {
        $services = DB::table('services')->get();
        return view('booking.createBooking', ['services' => $services]);
    }

    public function view()
    {
        // Check if the user is logged in as an admin
        if (session('admin_id') !== null) {
            // Retrieve all bookings if the user is an admin
            $bookings = Booking::all();
            return view('booking.displayBookingAdmin', ['bookings' => $bookings]);
        }
    }

    public function update(Request $request, $id)
    {
        // Find the booking by ID
        $booking = Booking::findOrFail($id);

        // Check if the user is authorized to update the booking
        if (Gate::denies('update', $booking) && Gate::denies('admin-update', $booking) && session('admin_id') === null) {
            abort(403);
        }

        // If the user is an admin or logged in as an admin, update the booking as an admin
        if (Gate::allows('admin-update', $booking) || session('admin_id') !== null) {
            // Validate the input
            $validatedData = $request->validate([
                'date' => 'required|after:today',
                'time' => 'required|after:08:59|before:17:01', //must between 9am to 5pm
                'services' => 'required|array',
                'services.*' => 'exists:services,id',
            ], [
                'date.after' => 'The new date must be tomorrow or a future date.',
            ]);

            // Update the booking
            $booking->date = $validatedData['date'];
            $booking->time = $validatedData['time'];
            $services = Service::whereIn('id', $validatedData['services'])->get();
            $booking->services()->sync($services);
            $booking->save();

            return redirect()->route('booking.displayBooking')->with('updateSuccess', 'Booking updated successfully');
        }

        // If the user is not an admin or not logged in as an admin, update the booking as a regular user
        $booking->date = $request->input('date');
        $booking->time = $request->input('time');
        $booking->services()->sync($request->input('services'));
        $booking->save();

        return redirect()->route('booking.displayBooking')->with('updateSuccess', 'Booking updated successfully');
    }

    public function delete($id)
    {
        // Find the booking by ID
        $booking = Booking::findOrFail($id);

        // Check if the user is authorized to delete the booking
        if (Gate::denies('delete', $booking) && Gate::denies('admin-delete', $booking) && session('admin_id') === null) {
            abort(403);
        }

        // If the user is an admin or logged in as an admin, delete the booking as an admin
        if (Gate::allows('admin-delete', $booking) || session('admin_id') !== null) {
            // Delete the booking and its associated services
            DB::table('booking_services')->where('booking_id', $booking->id)->delete();
            $booking->delete();
            return redirect()->route('booking.admin')->with('deleteSuccess', 'Booking deleted successfully');
        }
    }
}
