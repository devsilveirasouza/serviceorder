<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
