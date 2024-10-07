<?php

use App\Http\Controllers\EventsController;
use App\Http\Controllers\EventTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/

Route::get('/events', [EventsController::class, 'showAll']);

Route::post('/events', [EventsController::class, 'create']);

Route::patch('/events', [EventsController::class, 'update']);

Route::delete('/events', [EventsController::class, 'delete']);


Route::post('/eventsByType', [EventsController::class, 'showEventsByType']);

Route::get('/eventTypes', [EventTypeController::class, 'showAll']);

Route::post('/user/login', [UserController::class, 'login']);

Route::post('/user/register', [UserController::class, 'register']);