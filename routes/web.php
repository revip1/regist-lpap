<?php

use App\Http\Controllers\ProgramController;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('/programs', ProgramController::class);
Route::resource('tickets', TicketController::class);
Route::resource('/user_details', UserDetailController::class);
Route::get('/user-details/{id}/certificate', [UserDetailController::class, 'certificate'])->name('user_details.certificate');
