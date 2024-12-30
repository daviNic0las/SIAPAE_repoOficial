<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\EducationalController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FrequencyController;
use App\Http\Controllers\MedHistoryController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\StudentApiController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RegionalController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckAdmin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Start in:
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Parte Login:
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Admin Access:
    Route::middleware(CheckAdmin::class)->group( function() {
        Route::post('/admin/archive/{id}', [AdminController::class, 'archive'])->name('admin.archive');
        Route::get('/admin/deposit', [AdminController::class, 'deposit'])->name('admin.deposit');
        Route::post('/admin/restore/{id}', [AdminController::class, 'restore'])->name('admin.restore');
        Route::resource('admin', AdminController::class);
    });
});

// Funcional Site
Route::middleware('auth')->group(function () {
    
    // User Access:
    Route::resources([
        'anamnesis' => MedHistoryController::class,
        'attendance' => AttendanceController::class,
        'frequency' => FrequencyController::class,
        'record' => RecordController::class,
        'regional' => RegionalController::class,
        'educational' => EducationalController::class,
    ]);
    Route::get('/student/deposit', [StudentApiController::class, 'deposit'])->name('student.deposit');
    Route::post('/student/restore/{id}', [StudentApiController::class, 'restore'])->name('student.restore');
    Route::post('/studentapi/{id}', [StudentApiController::class, 'archive'])->name('student.archive');
    Route::resource('student', StudentController::class)->except('destroy');
    
    Route::post('/frequencies/multiple-details', [FrequencyController::class, 'updateDetails'])->name('frequency_details.update');
    Route::get('/studentapi/{id}', [StudentApiController::class, 'getStudentData']);

    // Export - User:
    Route::post('/regional/export/{id}', [RegionalController::class, 'generatePdf'])->name('regional.export');
    Route::post('/educational/export/{id}', [EducationalController::class, 'generatePdf'])->name('educational.export');

    // Admin Access:
    Route::middleware(CheckAdmin::class)->group( function() {
        Route::resources([
            'donation' => DonationController::class,
            'expense' => ExpenseController::class
        ]);
        // Export - Admin:
        Route::get('/expense/export', [ExpenseController::class, 'generatePdf'])->name('expense.export');
    });

    // Not Found:
    Route::fallback(function () {
        return view('errors.404');
    });
});

require __DIR__ . '/auth.php';
