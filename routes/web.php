<?php

use App\Http\Controllers\BatchController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RequestProgramController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserDetailController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile
Route::get('/profile', [ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->middleware('auth')->name('profile.destroy');

// User Details (no Auth)
Route::get('/user-details/create', [UserDetailController::class, 'create'])->name('user_details.create');
Route::post('/user-details/store', [UserDetailController::class, 'store'])->name('user_details.store');

// User Details (Admin)
Route::get('/user-details', [UserDetailController::class, 'index'])->middleware(['auth', 'role:admin'])->name('user_details.index');
Route::get('/user-details/{id}/edit', [UserDetailController::class, 'edit'])->middleware(['auth', 'role:admin'])->name('user_details.edit');
Route::put('/user-details/{id}', [UserDetailController::class, 'update'])->middleware(['auth', 'role:admin'])->name('user_details.update');
Route::delete('/user-details/{id}', [UserDetailController::class, 'destroy'])->middleware(['auth', 'role:admin'])->name('user_details.destroy');
Route::get('/user-details/{id}/certificate', [UserDetailController::class, 'certificate'])->middleware(['auth', 'role:admin'])->name('user_details.certificate');
Route::get('/user-details/export-excel', [UserDetailController::class, 'exportExcel'])->middleware(['auth', 'role:admin'])->name('user_details.export-excel');
Route::get('/user-details/{id}/export-pdf', [UserDetailController::class, 'exportPdf'])->middleware(['auth', 'role:admin'])->name('export_pdf');

// Tickets (Admin)
Route::get('/tickets/{id}/edit', [TicketController::class, 'edit'])->middleware(['auth', 'role:admin'])->name('tickets.edit');
Route::put('/tickets/{id}', [TicketController::class, 'update'])->middleware(['auth', 'role:admin'])->name('tickets.update');
Route::delete('/tickets/{id}', [TicketController::class, 'destroy'])->middleware(['auth', 'role:admin'])->name('tickets.destroy');

// Tickets (Admin, User, Company)
Route::get('/tickets/create', [TicketController::class, 'create'])->middleware(['auth', 'role:admin,user,company'])->name('tickets.create');
Route::post('/tickets', [TicketController::class, 'store'])->middleware(['auth', 'role:admin,user,company'])->name('tickets.store');
Route::get('/tickets', [TicketController::class, 'index'])->middleware(['auth', 'role:admin,user,company'])->name('tickets.index');

// Programs (Admin & Company)
Route::get('/programs', [ProgramController::class, 'index'])->middleware(['auth', 'role:admin,company'])->name('programs.index');
Route::get('/programs/create', [ProgramController::class, 'create'])->middleware(['auth', 'role:admin,company'])->name('programs.create');
Route::post('/programs', [ProgramController::class, 'store'])->middleware(['auth', 'role:admin,company'])->name('programs.store');

// Programs (Admin)
Route::get('/programs/{id}/edit', [ProgramController::class, 'edit'])->middleware(['auth', 'role:admin'])->name('programs.edit');
Route::put('/programs/{id}', [ProgramController::class, 'update'])->middleware(['auth', 'role:admin'])->name('programs.update');
Route::delete('/programs/{id}', [ProgramController::class, 'destroy'])->middleware(['auth', 'role:admin'])->name('programs.destroy');

// Batches (Admin)
Route::get('/batches', [BatchController::class, 'index'])->middleware(['auth', 'role:admin'])->name('batches.index');
Route::get('/batches/create', [BatchController::class, 'create'])->middleware(['auth', 'role:admin'])->name('batches.create');
Route::post('/batches', [BatchController::class, 'store'])->middleware(['auth', 'role:admin'])->name('batches.store');
Route::get('/batches/{batch}', [BatchController::class, 'show'])->middleware(['auth', 'role:admin'])->name('batches.show');
Route::get('/batches/{batch}/edit', [BatchController::class, 'edit'])->middleware(['auth', 'role:admin'])->name('batches.edit');
Route::put('/batches/{batch}', [BatchController::class, 'update'])->middleware(['auth', 'role:admin'])->name('batches.update');
Route::delete('/batches/{batch}', [BatchController::class, 'destroy'])->middleware(['auth', 'role:admin'])->name('batches.destroy');

// Request Program
Route::get('/request-program', [RequestProgramController::class, 'index'])->middleware(['auth', 'role:admin'])->name('request-program.index');
Route::get('/request-program/create', [RequestProgramController::class, 'create'])->middleware(['auth', 'role:admin,company'])->name('request-program.create');
Route::post('/request-program', [RequestProgramController::class, 'store'])->middleware(['auth', 'role:admin,company'])->name('request-program.store');
Route::get('/request-program/{id}/edit', [RequestProgramController::class, 'edit'])->middleware(['auth', 'role:admin'])->name('request-program.edit');
Route::put('/request-program/{id}', [RequestProgramController::class, 'update'])->middleware(['auth', 'role:admin'])->name('request-program.update');
Route::delete('request-program/{id}', [RequestProgramController::class, 'destroy'])->middleware(['auth', 'role:admin'])->name('request-program.destroy');

// Contacts (Bisa Diakses Semua User)
Route::get('/contacts', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');

require __DIR__.'/auth.php';
