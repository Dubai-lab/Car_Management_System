<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;

Route::get('/', [VehicleController::class, 'index'])->name('home');

// Vehicle routes
Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
Route::get('/vehicles/{id}', [VehicleController::class, 'show'])->name('vehicles.show');
Route::get('/vehicles/{id}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
Route::put('/vehicles/{id}', [VehicleController::class, 'update'])->name('vehicles.update');
Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');
Route::get('/search', [VehicleController::class, 'search'])->name('vehicles.search');
