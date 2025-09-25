<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

// Ruta para login
Route::post('/login', [AuthController::class, 'login']);

// Grupo de rutas para manejar los recursos
Route::prefix('')->group(function () {

    // Rutas de recursos para cards, lessons y categories
    Route::apiResources([
        'users'     => UserController::class,
        'cards'     => CardController::class,
        'lessons'   => LessonController::class,
        'categories'=> CategoryController::class,

        
    ]);
    
    // Rutas para restaurar y eliminar
    Route::prefix('cards')->group(function () {
        Route::post('{id}/restore', [CardController::class, 'restore']);
    });

    Route::prefix('categories')->group(function () {
        Route::post('{id}/restore', [CategoryController::class, 'restore']);
    });

    Route::prefix('lessons')->group(function () {
        Route::post('{id}/restore', [LessonController::class, 'restore']);
    });
});
