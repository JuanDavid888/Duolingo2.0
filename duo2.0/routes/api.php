<?php

use App\Http\Controllers\AnswerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

// Route for Login
Route::post('/login', [AuthController::class, 'login']);

// Group of routes for each table
Route::prefix('')->group(function () {

    // Rutas de recursos para cards, lessons y categories
    Route::apiResources([
        'users'     => UserController::class,
        'cards'     => CardController::class,
        'lessons'   => LessonController::class,
        'categories'=> CategoryController::class,
        'answers'   => AnswerController::class,
    ]);
    
    // Routess for delete and restore
    Route::prefix('cards')->group(function () {
        Route::post('{id}/restore', [CardController::class, 'restore']);
    });

    Route::prefix('categories')->group(function () {
        Route::post('{id}/restore', [CategoryController::class, 'restore']);
    });

    Route::prefix('lessons')->group(function () {
        Route::post('{id}/restore', [LessonController::class, 'restore']);
    });

    Route::prefix('answers')->group(function () {
        Route::post('{id}/restore', [AnswerController::class, 'restore']);
    });
});
