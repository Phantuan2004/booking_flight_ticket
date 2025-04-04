<?php

\Illuminate\Support\Facades\Route::get('/', [\App\Http\Controllers\Api\FlightController::class, 'index'])->name('index');
\Illuminate\Support\Facades\Route::post('add', [\App\Http\Controllers\Api\FlightController::class, 'store'])->name('store');
