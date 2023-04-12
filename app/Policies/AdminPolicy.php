<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function admin(Admin $admin)
    {
        return true; // Or implement your own logic here
    }
    public function update(Admin $admin)
    {
        return true; // Or implement your own logic here
    }

    public function delete(Admin $admin)
    {
        return true; // Or implement your own logic here
    }
}
