<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;
    protected $guard = 'admin';
    protected $fillable = [
        'name', 'email', 'phone', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function isAdmin()
    {
        return true; // Or implement your own logic here
    }
}
