<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'client_name',
        'email',
        'phone',
        'event_date',
        'event_type',
        'location',
        'package_type',
        'special_requests',
        'status'
    ];

    protected $casts = [
        'event_date' => 'date'
    ];
}
