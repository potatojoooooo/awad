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
        'serviceID',
        'name',
        'phone'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
