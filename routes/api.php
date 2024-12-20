<?php

use App\Http\Controllers\ProgramController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/program', [ProgramController::class, 'index']);
Route::get('/program/{id}', [ProgramController::class, 'show']);
Route::post('/program', [ProgramController::class, 'store']);
Route::put('/program/{id}', [ProgramController::class, 'update']);
Route::delete('/program/{id}', [ProgramController::class, 'destroy']);

Route::get('/ticket', [TicketController::class, 'index']);
Route::post('/ticket', [TicketController::class, 'store']);
Route::get('/ticket/{id}', [TicketController::class, 'show']);
Route::put('/ticket/{id}', [TicketController::class, 'update']);
Route::delete('/ticket/{id}', [TicketController::class, 'destroy']);