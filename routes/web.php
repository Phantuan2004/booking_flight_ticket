<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ConfirmController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FlightsController;
use App\Http\Controllers\HistoriesController;
use App\Http\Controllers\OneWayController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoundTripController;
use App\Http\Controllers\SuccessController;
use Illuminate\Support\Facades\Route;

// Route page client
Route::prefix("")->group(function () {
    Route::get('/', [FlightsController::class, 'index'])->name('index');
    Route::get('/flight-search-oneway', [OneWayController::class, 'queryOneWay'])->name('flight-search-oneway');
    Route::get('/flight-search-roundtrip', [RoundTripController::class, 'queryRoundTrip'])->name('flight-search-roundtrip');
    Route::get('/datve_khuhoi', [RoundTripController::class, 'datve_khuhoi'])->name('datve_khuhoi');
    Route::post('/xacnhan', [ConfirmController::class, 'confirm'])->name('confirm');
    Route::post('/thanhtoan', [PaymentController::class, 'payment'])->name('payment');
    Route::post('/thanhcong', [SuccessController::class, 'success'])->name('success');
    Route::get('/lienhe', [ContactController::class, 'contact'])->name('contact');
    Route::get('/lichsudatve', [HistoriesController::class, 'history'])->name('history');
    Route::delete('/huyve/{id}', [HistoriesController::class, 'huyve'])->name('huyve');
});

// Route page admin
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'admin'])->name('admin');
    Route::get('/search-flight-admin', [AdminController::class, 'search_flight_admin'])->name('search-flight-admin');
    Route::get('/search-airline-admin', [AdminController::class, 'search_airline_admin'])->name('search-airline-admin');
    Route::post('/add-flight', [AdminController::class, 'store'])->name('add-flight');
    Route::put('/edit-flight/{id}', [AdminController::class, 'update'])->name('edit-flight');
    Route::delete('/delete-flight/{id}', [AdminController::class, 'delete'])->name('delete-flight');
    Route::post('/cancel-booking/{id}', [AdminController::class, 'cancel'])->name('cancel-booking');

    Route::post('/add-airline', [AdminController::class, 'addAirline'])->name('add-airline');
    Route::put('/update-airline/{id}', [AdminController::class, 'editAirline'])->name('update-airline');
    Route::delete('/delete-airline/{id}', [AdminController::class, 'deleteAirline'])->name('delete-airline');

    Route::post('/add-user', [AdminController::class, 'adduser'])->name('add-user');
    Route::put('/edit-user/{id}', [AdminController::class, 'editUser'])->name('edit-user');
    Route::delete('/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('delete-user');
});
