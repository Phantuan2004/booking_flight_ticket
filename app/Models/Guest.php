<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;
    protected $table = 'guests';
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'booking_count',
        'last_booking_date',
    ];
}
