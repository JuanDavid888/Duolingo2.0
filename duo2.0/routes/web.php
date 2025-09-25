<?php

use Illuminate\Support\Facades\Route;

// Ruta para la página de inicio (video introductorio)
Route::get('/', function () {
    return view('auth.login');
})->name('inicio');

// Ruta para la página principal después del video
Route::get('/inicio', function () {
    return view('auth.inicio');
})->name('inicio.principal');

// Ruta login (si necesitas una específica para login)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Ruta para la página de ejercicios de la web 
Route::get('/principal', function () {
    return view('auth.plf');
})->name('inicio.web');

// Ruta para la página de ejercicios de la web 
Route::get('/registro', function () {
    return view('auth.rgs');
})->name('inicio.registro');
Route::post('/registro', function () {
    return view('auth.rgs');
})->name('inicio.registro');
