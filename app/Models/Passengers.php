<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passengers extends Model
{
    use HasFactory;
    protected $table = 'passengers_tables';
    protected $fillable = [
        'booking_id',
        'name',
        'date_of_birth',
        'passport_number'
    ];
}
