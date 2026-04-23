<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\SubmissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
require __DIR__.'/auth.php';
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Forms CRUD
        Route::resource('forms', FormController::class);
        Route::get('forms/{id}/fields', [FormController::class, 'fields'])->name('forms.fields');
        // Users
        Route::resource('users', UserController::class)->only(['index', 'show']);

        // Submissions
        Route::resource('submissions', SubmissionController::class);

        // Route::delete('submissions/{id}', [SubmissionController::class, 'destroy'])->name('submissions.destroy');

        // Import
        Route::get('import', [ImportController::class, 'index'])->name('import.index');
        Route::post('import/preview', [ImportController::class, 'preview'])->name('import.preview');
        Route::post('import/store', [ImportController::class, 'store'])->name('import.store');

        // Export
        Route::get('export', [ExportController::class, 'export'])->name('export');
    });

    
require __DIR__.'/auth.php';
