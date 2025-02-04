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

// Route yang bisa diakses oleh semua user yang login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Semua route dalam grup ini hanya bisa diakses oleh admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    // user details atau regist lpap
        Route::get('/user-details', [UserDetailController::class, 'index'])->name('user_details.index');
        Route::get('/user-details/{id}/edit', [UserDetailController::class, 'edit'])->name('user_details.edit');
        Route::put('/user-details/{id}', [UserDetailController::class, 'update'])->name('user_details.update');
        Route::delete('/user-details/{id}', [UserDetailController::class, 'destroy'])->name('user_details.destroy');
        Route::get('/user-details/{id}/certificate', [UserDetailController::class, 'certificate'])->name('user_details.certificate');
        Route::get('/user-details/export-excel', [UserDetailController::class, 'exportExcel'])->name('user_details.export-excel');
        Route::get('/user-details/{id}/export-pdf', [UserDetailController::class, 'exportPdf'])->name('export_pdf');

    Route::prefix('tickets')->name('tickets.')->group(function () {
        Route::get('/{id}/edit', [TicketController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TicketController::class, 'update'])->name('update');
        Route::delete('/{id}', [TicketController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('programs')->name('programs.')->group(function () {
        Route::get('/', [ProgramController::class, 'index'])->name('index');
        Route::get('/{id}/edit', [ProgramController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ProgramController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProgramController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('batches')->name('batches.')->group(function () {
        Route::get('/', [BatchController::class, 'index'])->name('index');
        Route::get('/create', [BatchController::class, 'create'])->name('create');
        Route::post('/', [BatchController::class, 'store'])->name('store');
        Route::get('/{batch}', [BatchController::class, 'show'])->name('show');
        Route::get('/{batch}/edit', [BatchController::class, 'edit'])->name('edit');
        Route::put('/{batch}', [BatchController::class, 'update'])->name('update');
        Route::delete('/{batch}', [BatchController::class, 'destroy'])->name('destroy');
    });
    

    
});

Route::middleware(['auth', 'role:admin,user,company'])->group(function () {

    // regist lpap
    Route::get('/user-details/create', [UserDetailController::class, 'create'])->name('user_details.create');
    Route::post('/user-details/store', [UserDetailController::class, 'store'])->name('user_details.store');
    // export
    Route::get('/user_details/{id}/export-pdf', [UserDetailController::class, 'exportPdf'])->name('user_details.export-pdf');
    // regist tiket
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
});

Route::middleware(['auth', 'role:admin,company'])->group(function () {
    Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
    Route::get('/programs/create', [ProgramController::class, 'create'])->name('programs.create');
    Route::post('/programs', [ProgramController::class, 'store'])->name('programs.store');
});
    
Route::get('/contacts', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');

require __DIR__.'/auth.php';
