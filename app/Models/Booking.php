<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'date',
        'time',
        'serviceID',
        'phone'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
