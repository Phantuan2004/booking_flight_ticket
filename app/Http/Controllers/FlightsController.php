<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightsController extends Controller
{
        public function index()
    {
        $flights = Flight::all();
        return view('index', compact('flights'));
    }
}
