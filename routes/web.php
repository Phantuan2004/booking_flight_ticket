<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

// Route page client
Route::get('/', [\App\Http\Controllers\UserController::class, 'index'])->name('index');
Route::get('/flight-search', [\App\Http\Controllers\UserController::class, 'search_flights'])->name('flight-search');
Route::get('/datve', [\App\Http\Controllers\UserController::class, 'datve'])->name('datve');
Route::post('/xacnhan', [\App\Http\Controllers\UserController::class, 'xacnhan'])->name('xacnhan');
Route::post('/thanhtoan', [\App\Http\Controllers\UserController::class, 'thanhtoan'])->name('thanhtoan');
Route::post('/thanhcong', [\App\Http\Controllers\UserController::class, 'thanhcong'])->name('thanhcong');
Route::get('/lienhe', [\App\Http\Controllers\UserController::class, 'lienhe'])->name('lienhe');

// Route page admin
Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'admin'])->name('admin');
Route::post('/admin/add-flight', [\App\Http\Controllers\AdminController::class, 'store'])->name('add-flight');
Route::put('/admin/edit-flight/{id}', [\App\Http\Controllers\AdminController::class, 'update'])->name('edit-flight');
Route::delete('/admin/delete-flight/{id}', [\App\Http\Controllers\AdminController::class, 'delete'])->name('delete-flight');
Route::post('/admin/cancel-booking/{id}', [\App\Http\Controllers\AdminController::class, 'cancel'])->name('cancel-booking');

Route::post('/admin/add-user', [AdminController::class, 'adduser'])->name('add-user');
Route::put('/admin/edit-user/{id}', [AdminController::class, 'editUser'])->name('edit-user');
Route::delete('/admin/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('delete-user');

Route::get('/admin/get-user-guest', [GuestController::class, 'getUserGuest'])->name('get-user-guest');
Route::delete('/admin/delete-user-guest/{id}', [GuestController::class, 'deleteUserGuest'])->name('delete-user-guest');
