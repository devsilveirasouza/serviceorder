<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

// Users
Route::get('/users',                    [UserController::class, 'index'])->name('users.index');
Route::get('/users/create',             [UserController::class, 'create'])->name('users.create');
Route::post('/users/store',             [UserController::class, 'store'])->name('users.store');
Route::get('/users/show/{user}',        [UserController::class, 'show'])->name('users.show');
Route::get('/users/edit/{user}',        [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/update/{user}',      [UserController::class, 'update'])->name('users.update');
Route::delete('/users/delete/{user}',   [UserController::class, 'destroy'])->name('users.destroy');

// Clients
Route::get('/clients',                  [ClientController::class, 'index'])->name('clients.index');
Route::get('/clients/edit/{client}',    [ClientController::class, 'edit'])->name('clients.edit');
Route::put('/clients/updated/{client}', [ClientController::class, 'update'])->name('clients.update');
Route::get('/clients/create',           [ClientController::class, 'create'])->name('clients.create');
Route::post('/clients/store',           [ClientController::class, 'store'])->name('clients.store',);
Route::get('/clients/show/{client}',    [ClientController::class, 'show'])->name('clients.show');
Route::delete('/clients/delete/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');   

// Vehicles
Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
Route::post('/vehicles/store', [VehicleController::class, 'store'])->name('vehicles.store');
Route::get('/vehicles/show/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');
Route::get('/vehicles/edit/{vehicle}', [VehicleController::class, 'edit'])->name('vehicles.edit');
Route::put('/vehicles/update/{vehicle}', [VehicleController::class, 'update'])->name('vehicles.update');
Route::delete('/vehicles/delete/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
