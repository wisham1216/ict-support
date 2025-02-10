<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\AuthController;

Route::get("/", function () {
    return "Hello World";
});
Route::get('/access-types/{system}/accesses', [SystemController::class, 'getAccesses']);
Route::get('/systems/{system}/accesses', [SystemController::class, 'getAccesses']);

// Public routes (no auth required)
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Ticket routes
    Route::get('tickets', [TicketController::class, 'index']);
    Route::get('tickets/{ticket}', [TicketController::class, 'show']);
    Route::post('tickets', [TicketController::class, 'store']);
    Route::put('tickets/{ticket}', [TicketController::class, 'update']);
    Route::delete('tickets/{ticket}', [TicketController::class, 'destroy']);

    // Additional ticket actions
    Route::post('tickets/{ticket}/status', [TicketController::class, 'updateStatus']);
    Route::post('tickets/{ticket}/priority', [TicketController::class, 'updatePriority']);
    Route::post('tickets/{ticket}/assign', [TicketController::class, 'assign']);

    // Auth routes
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);
});
