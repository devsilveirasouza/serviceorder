<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/users',                    [UserController::class, 'index'])->name('users.index');
Route::get('/users/create',             [UserController::class, 'create'])->name('users.create');
Route::post('/users/store',             [UserController::class, 'store'])->name('users.store');
Route::get('/users/show/{user}',        [UserController::class, 'show'])->name('users.show');
Route::get('/users/edit/{user}',               [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/update/{user}',      [UserController::class, 'update'])->name('users.update');
Route::delete('/users/delete/{user}',   [UserController::class, 'destroy'])->name('users.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
