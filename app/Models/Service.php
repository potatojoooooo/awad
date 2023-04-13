<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';
    public $timestamps = false;


    protected $fillable = [
        'name',
        'price',
        'description',
        'image'
    ];

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_services');
    }
}
