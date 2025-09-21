<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JamaahController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\KantorController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Jamaah Routes
Route::resource('jamaah', JamaahController::class);

// Paket Routes
Route::resource('paket', PaketController::class);

// Group Routes
Route::resource('group', GroupController::class);

// Kantor Routes
Route::resource('kantor', KantorController::class);

// Pembayaran Routes
Route::resource('pembayaran', PembayaranController::class);

// User Routes
Route::resource('user', UserController::class);