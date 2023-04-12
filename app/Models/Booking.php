<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $table = 'bookings';

    protected $fillable = [
        'date',
        'time',
        'userID'
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'booking_services');
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
