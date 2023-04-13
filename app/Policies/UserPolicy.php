<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Admin;
use App\Models\Service;
use App\Models\Booking;
use Illuminate\Support\Facades\Gate;

class UserPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(Admin $admin)
    {
        return true;
    }

    public function view(Admin $admin, User $user)
    {
        return true;
    }

    public function create(Admin $admin)
    {
        return Gate::allows('manage-users');
    }

    public function update(Admin $admin, User $user)
    {
        return Gate::allows('manage-users');
    }

    public function delete(Admin $admin, User $user)
    {
        return Gate::allows('manage-users');
    }
}