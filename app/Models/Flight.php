<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;
    protected $table = 'flights';
    protected $fillable = [
        'airline_id',
        'flight_code',
        'departure',
        'destination',
        'departure_time',
        'flight_start',
        'flight_end',
        'price',
        'seats',
        'available_seats',
        'status'
    ];



    public function airline(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Airline::class);
    }
}
