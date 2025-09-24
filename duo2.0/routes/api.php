<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

// Ruta para obtener la información del usuario autenticado
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Ruta para la salud del API
Route::get('/health', fn() => ['ok' => true]);

// Ruta para login
Route::post('/login', [AuthController::class, 'login']);

// Grupo de rutas para manejar los recursos de cards, lessons y categories
Route::prefix('')->group(function () {

    // Rutas de recursos para cards, lessons y categories
    Route::apiResources([
        'users'     => UserController::class,
        'cards'     => CardController::class,
        'lessons'   => LessonController::class,
        'categories'=> CategoryController::class,

        
    ]);
    
    // Rutas para restaurar y eliminar cards
    Route::prefix('cards')->group(function () {
        Route::post('{id}/restore', [CardController::class, 'restore']);
    });

    // Rutas para restaurar y eliminar categories
    Route::prefix('categories')->group(function () {
        Route::post('{id}/restore', [CategoryController::class, 'restore']);
    });
});
