<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CategoryController;

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
        'cards'     => CardController::class,
        'lessons'   => LessonController::class,
        'categories'=> CategoryController::class,
    ]);

    // Ruta para obtener las cards de una categoría
    Route::get('/categories/{category}/cards', [CategoryController::class, 'cards']);
    
    // Rutas para restaurar y eliminar cards
    Route::prefix('cards')->group(function () {
        Route::post('{id}/restore', [CardController::class, 'restore']);
        Route::delete('{id}/force-delete', [CardController::class, 'forceDelete']);
    });

    // Ruta para asignar o desasignar imágenes o archivos de cards
    Route::post('cards/{card}/attach-file', [CardController::class, 'attachFile']);
    Route::delete('cards/{card}/detach-file', [CardController::class, 'detachFile']);
    
    // Relación de cards con lecciones (asociar/desasociar)
    Route::post('cards/{card}/lessons/{lesson}', [CardController::class, 'attachLesson']);
    Route::delete('cards/{card}/lessons/{lesson}', [CardController::class, 'detachLesson']);
});

