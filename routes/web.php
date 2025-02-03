<?php

use App\Http\Controllers\BatchController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserDetailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('user-details')->name('user_details.')->group(function () {
    Route::get('/', [UserDetailController::class, 'index'])->name('index');
    Route::get('/create', [UserDetailController::class, 'create'])->name('create');
    Route::post('/', [UserDetailController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [UserDetailController::class, 'edit'])->name('edit');
    Route::put('/{id}', [UserDetailController::class, 'update'])->name('update');
    Route::delete('/{id}', [UserDetailController::class, 'destroy'])->name('destroy');

    // Route tambahan
    Route::get('/{id}/certificate', [UserDetailController::class, 'certificate'])->name('certificate');
    Route::get('/{id}/export-pdf', [UserDetailController::class, 'exportPdf'])->name('export_pdf');
    Route::get('/export-excel', [UserDetailController::class, 'exportExcel'])->name('export_excel');
});
Route::get('/user_details/{id}/export-pdf', [UserDetailController::class, 'exportPdf'])->name('user_details.export-pdf');
Route::get('/user-details/export-excel', [UserDetailController::class, 'exportExcel'])->name('user_details.export-excel');
// Routes untuk TicketController
Route::prefix('tickets')->name('tickets.')->group(function () {
    Route::get('/', [TicketController::class, 'index'])->name('index');
    Route::get('/create', [TicketController::class, 'create'])->name('create');
    Route::post('/', [TicketController::class, 'store'])->name('store');
    Route::get('/{id}', [TicketController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [TicketController::class, 'edit'])->name('edit');
    Route::put('/{id}', [TicketController::class, 'update'])->name('update');
    Route::delete('/{id}', [TicketController::class, 'destroy'])->name('destroy');
});

// Routes untuk ProgramController
Route::prefix('programs')->name('programs.')->group(function () {
    Route::get('/', [ProgramController::class, 'index'])->name('index');
    Route::get('/create', [ProgramController::class, 'create'])->name('create'); // Jika ada form create
    Route::post('/', [ProgramController::class, 'store'])->name('store');        // Jika ada simpan data
    Route::get('/{id}', [ProgramController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [ProgramController::class, 'edit'])->name('edit');  // Jika ada edit data
    Route::put('/{id}', [ProgramController::class, 'update'])->name('update');   // Jika ada update data
    Route::delete('/{id}', [ProgramController::class, 'destroy'])->name('destroy'); // Jika ada hapus data
});

Route::prefix('batches')->name('batches.')->group(function () {
    Route::get('/', [BatchController::class, 'index'])->name('index');
    Route::get('/create', [BatchController::class, 'create'])->name('create');
    Route::post('/', [BatchController::class, 'store'])->name('store');
    Route::get('/{id}', [BatchController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [BatchController::class, 'edit'])->name('edit');
    Route::put('/{id}', [BatchController::class, 'update'])->name('update');
    Route::delete('/{id}', [BatchController::class, 'destroy'])->name('destroy');
});

Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index')->middleware('auth');
Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create')->middleware('auth');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store')->middleware('auth');
Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show')->middleware('auth');
Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit')->middleware('auth');
Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update')->middleware('auth');
Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy')->middleware('auth');

Route::get('/contacts', function () {
    return view('contacts.contact');
});

require __DIR__.'/auth.php';
