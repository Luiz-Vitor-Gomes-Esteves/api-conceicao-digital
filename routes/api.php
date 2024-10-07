<?php

use App\Http\Controllers\EventsController;
use App\Http\Controllers\EventTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthDeviceMiddleware;

Route::middleware(AuthDeviceMiddleware::class)->group(function () {
    Route::get('/events', [EventsController::class, 'showAll']);
    Route::post('/eventsByType', [EventsController::class, 'showEventsByType']);
    Route::get('/eventTypes', [EventTypeController::class, 'showAll']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/events', [EventsController::class, 'create']);
    Route::patch('/events', [EventsController::class, 'update']);
    Route::delete('/events', [EventsController::class, 'delete']);
});

// Public user routes
Route::post('/user/login', [UserController::class, 'login']);
Route::post('/user/register', [UserController::class, 'register']);
