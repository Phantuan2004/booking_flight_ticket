<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\FlightController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route page client
Route::get('/', [\App\Http\Controllers\UserController::class, 'index'])->name('index');
Route::get('/flight-search-oneway', [\App\Http\Controllers\UserController::class, 'search_flights_oneway'])->name('flight-search-oneway');
Route::get('/flight-search-roundtrip', [\App\Http\Controllers\UserController::class, 'search_flights_roundtrip'])->name('flight-search-roundtrip');
Route::get('/datve_khuhoi', [\App\Http\Controllers\UserController::class, 'datve_khuhoi'])->name('datve_khuhoi');
Route::post('/xacnhan', [\App\Http\Controllers\UserController::class, 'xacnhan'])->name('xacnhan');
Route::post('/thanhtoan', [\App\Http\Controllers\UserController::class, 'thanhtoan'])->name('thanhtoan');
Route::post('/thanhcong', [\App\Http\Controllers\UserController::class, 'thanhcong'])->name('thanhcong');
Route::get('/lienhe', [\App\Http\Controllers\UserController::class, 'lienhe'])->name('lienhe');
Route::get('/lichsudatve', [UserController::class, 'lichsudatve'])->name('lichsudatve');
Route::delete('/huyve/{id}', [UserController::class, 'huyve'])->name('huyve');

// Route page admin
Route::prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'admin'])->name('admin');
    Route::get('/search-flight-admin', [AdminController::class, 'search_flight_admin'])->name('search-flight-admin');
    Route::get('/search-airline-admin', [AdminController::class, 'search_airline_admin'])->name('search-airline-admin');
    Route::post('/add-flight', [\App\Http\Controllers\AdminController::class, 'store'])->name('add-flight');
    Route::put('/edit-flight/{id}', [\App\Http\Controllers\AdminController::class, 'update'])->name('edit-flight');
    Route::delete('/delete-flight/{id}', [\App\Http\Controllers\AdminController::class, 'delete'])->name('delete-flight');
    Route::post('/cancel-booking/{id}', [\App\Http\Controllers\AdminController::class, 'cancel'])->name('cancel-booking');

    Route::post('/add-airline', [AdminController::class, 'addAirline'])->name('add-airline');
    Route::put('/update-airline/{id}', [AdminController::class, 'editAirline'])->name('update-airline');
    Route::delete('/delete-airline/{id}', [AdminController::class, 'deleteAirline'])->name('delete-airline');

    Route::post('/add-user', [AdminController::class, 'adduser'])->name('add-user');
    Route::put('/edit-user/{id}', [AdminController::class, 'editUser'])->name('edit-user');
    Route::delete('/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('delete-user');
});
