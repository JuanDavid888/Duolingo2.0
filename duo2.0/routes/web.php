<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardController;

// Ruta para el formulario de login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');

// Ruta para procesar el login
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Ruta para procesar el logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Ruta para el dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::resource('cards', CardController::class);