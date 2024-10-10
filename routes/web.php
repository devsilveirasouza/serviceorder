<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
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
    Route::get('/vehicles',                 [VehicleController::class, 'index'])->name('vehicles.index');
    Route::get('/vehicles/create',          [VehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles/store',          [VehicleController::class, 'store'])->name('vehicles.store');
    Route::get('/vehicles/show/{vehicle}',  [VehicleController::class, 'show'])->name('vehicles.show');
    Route::get('/vehicles/edit/{vehicle}',  [VehicleController::class, 'edit'])->name('vehicles.edit');
    Route::put('/vehicles/update/{vehicle}', [VehicleController::class, 'update'])->name('vehicles.update');
    Route::delete('/vehicles/delete/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');
    // Parts
    Route::get('/parts',                    [PartController::class, 'index'])->name('parts.index');
    Route::get('/parts/create',             [PartController::class, 'create'])->name('parts.create');
    Route::post('/parts/store',             [PartController::class, 'store'])->name('parts.store');
    Route::get('/parts/show/{part}',        [PartController::class, 'show'])->name('parts.show');
    Route::get('/parts/edit/{part}',        [PartController::class, 'edit'])->name('parts.edit');
    Route::put('/parts/update/{part}',      [PartController::class, 'update'])->name('parts.update');
    Route::delete('/parts/delete/{part}',   [PartController::class, 'destroy'])->name('parts.destroy');
    // Services
    Route::get('/services',                 [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/create',          [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services/store',          [ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/show/{service}',  [ServiceController::class, 'show'])->name('services.show');
    Route::get('/services/edit/{service}',  [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/update/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/service/delete/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
    // Orders
    Route::get('/orders',                   [OrderController::class, 'index'])->name('orders.index');
    Route::get('/get-vehicles/{client_id}', [OrderController::class, 'getVehicles'])->name('vehicles.getVehicles');
    Route::get('/orders/create',            [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders/store',            [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/show/{order}',      [OrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/update/{order}',    [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/delete/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    // Orders Items
    Route::get('/order-items/create/{order_id}/{client_id}/{vehicle_id}',   [OrderItemController::class, 'create'])->name('orderItems.create');
    Route::post('/order-items/store',                                       [OrderItemController::class, 'addItemsOrder'])->name('orderItems.store');
    Route::get('/order-items/edit/{order}',                                 [OrderItemController::class, 'editItemsOrder'])->name('ordersItems.edit');
    Route::put('/order-items/update/{order}',                               [OrderItemController::class, 'updateItemsOrder'])->name('ordersItems.update');
    Route::get('/order-items/show/{order}',                                 [OrderItemController::class, 'itemsDetials'])->name('ordersItems.details');

    Route::get('/orders/{order}/pdf',                                       [OrderController::class, 'generatePDF'])->name('orders.generatePDF');
});

require __DIR__ . '/auth.php';
