<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;
use App\Models\Admin;
use App\Models\Service;
use App\Models\User;
use App\Models\Booking;

class ServicePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(Admin $admin)
    {
        return true;
    }

    public function view(Admin $admin, Service $service)
    {
        return true;
    }

    public function create(Admin $admin)
    {
        return Gate::allows('manage-services');
    }

    public function update(Admin $admin, Service $service)
    {
        return Gate::allows('manage-services');
    }

    public function delete(Admin $admin, Service $service)
    {
        return Gate::allows('manage-services');
    }
}