<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\AuthorizationException;


class BookingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can edit the booking.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Booking  $booking
     * @return mixed
     */
    public function edit(Admin $admin, Booking $booking)
    {
        return $admin->id === $booking->admin_id;
    }

    /**
     * Determine whether the user can delete the booking.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Booking  $booking
     * @return mixed
     */
    public function delete(Admin $admin, Booking $booking)
    {
        // Check if the authenticated user is an admin
        if (!auth()->guard('admin')->check()) {
            return false;
        }
    
        // Check if the authenticated admin is the same as the admin in the booking
        if (auth()->guard('admin')->user()->id !== $booking->admin_id) {
            return false;
        }
    
        return true;
    }
    
    
    
}
