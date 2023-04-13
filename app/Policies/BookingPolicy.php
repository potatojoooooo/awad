<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;
use App\Models\Admin;
use App\Models\Service;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class BookingPolicy
{
    use HandlesAuthorization;

    public function viewAny(Admin $admin)
    {
        return true;
    }

    public function view(Admin $admin, Booking $booking)
    {
        return true;
    }

    public function create(Admin $admin)
    {
        return Gate::allows('manage-bookings');
    }

    public function update(Admin $admin, Booking $booking)
    {
        return Gate::allows('admin-update');
    }

    public function delete(Admin $admin, Booking $booking)
    {
        return Gate::allows('admin-delete');
    }
}
