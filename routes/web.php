<?php

use App\Http\Controllers\AdminController;
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
// Route::get('/search_danhsachdatve', [UserController::class, 'search_danhsachdatve'])->name('search_danhsachdatve');
Route::delete('/huyve/{id}', [UserController::class, 'huyve'])->name('huyve');

// Route page admin
Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'admin'])->name('admin');
Route::post('/admin/add-flight', [\App\Http\Controllers\AdminController::class, 'store'])->name('add-flight');
Route::put('/admin/edit-flight/{id}', [\App\Http\Controllers\AdminController::class, 'update'])->name('edit-flight');
Route::delete('/admin/delete-flight/{id}', [\App\Http\Controllers\AdminController::class, 'delete'])->name('delete-flight');
Route::post('/admin/cancel-booking/{id}', [\App\Http\Controllers\AdminController::class, 'cancel'])->name('cancel-booking');

Route::post('/admin/add-user', [AdminController::class, 'adduser'])->name('add-user');
Route::put('/admin/edit-user/{id}', [AdminController::class, 'editUser'])->name('edit-user');
Route::delete('/admin/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('delete-user');
