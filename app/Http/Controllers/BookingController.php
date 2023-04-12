<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\UnauthorizedException;

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

    public function show(Booking $booking)
    {
        if (Auth::guard('admin')->check()) {
            $admin = Auth::user();
            $admin_id = $admin->id;
            session(['admin_id' => $admin_id]);
            $bookings = Booking::all();
            return view('booking.displayBookingAdmin', ['id' => $admin_id], compact('bookings'));
        }
    }

    public function edit(Booking $booking)
    {
        $services = DB::table('services')->get();
        return view('booking.updateBooking', ['services' => $services], compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        if (auth()->guard('admin')->check()) {
            $this->authorize('update', $booking);

            $validatedData = $request->validate([
                'date' => 'required|after:today',
                'time' => 'required|after:08:59|before:17:01', //must between 9am to 5pm
                'services' => 'required|array',
                'services.*' => 'exists:services,id',
            ], [
                'date.after' => 'The new date must be tomorrow or a future date.',
            ]);

            $booking->date = $validatedData['date'];
            $booking->time = $validatedData['time'];

            $services = Service::whereIn('id', $validatedData['services'])->get();
            $booking->services()->sync($services);

            $booking->save();

            return redirect()->route('booking.admin')->with('updateSuccess', 'Booking updated successfully');
        }
        abort(403); // user is not authorized to perform this action
    }

    public function delete(Admin $admin, Booking $booking)
    {
        // Check if the authenticated user is an admin
        if (!auth()->guard('admin')->check()) {
            throw new AuthorizationException('Unauthorized action.');
        }

        // Check if the authenticated admin can delete the booking
        if (Gate::denies('delete', $booking)) {
            throw new AuthorizationException('Unauthorized action.');
        }

        // Delete the booking
        $booking->delete();

        return redirect()->route('booking.displayBookingAdmin')->with('success', 'Booking deleted successfully.');
    }

    public function index()
    {
        if (auth()->guard('admin')->check()) {
            $bookings = Booking::orderBy('created_at', 'desc')->paginate(10);
        } else {
            if (!auth()->check()) {
                return redirect()->route('login');
            }
            $user = Auth::user(); // Get the currently authenticated user
            $bookings = Booking::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10); // Get all bookings made by the user
        }
        return view('booking.index', compact('bookings'));
    }
}
