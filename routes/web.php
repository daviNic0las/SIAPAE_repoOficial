<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DiagnosticController;
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

// Login:
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Funcional Site
Route::middleware('auth')->group(function () {
    
    // User Access:
    Route::resources([
        'anamnesis' => MedHistoryController::class,
        'attendance' => AttendanceController::class,
        'diagnostic' => DiagnosticController::class,
        'frequency' => FrequencyController::class,
        'record' => RecordController::class,
        'regional' => RegionalController::class,
        'educational' => EducationalController::class,
    ]);
    Route::get('/student/trash', [StudentApiController::class, 'trash'])->name('student.trash');
    Route::post('/student/restore/{id}', [StudentApiController::class, 'restore'])->name('student.restore');
    Route::resource('student', StudentController::class)->except('destroy');
    // Route::delete('/student/{id}', [StudentController::class, 'destroyDefinitive'])->name('student.destroyDefinitive');
    Route::post('/studentapi/{id}', [StudentApiController::class, 'destroy'])->name('student.destroy');
    
    Route::post('/frequencies/multiple-details', [FrequencyController::class, 'updateDetails'])->name('frequency_details.update');
    Route::get('/studentapi/{id}', [StudentApiController::class, 'getStudentData']);

    // Admin Access:
    Route::middleware(CheckAdmin::class)->group( function() {
        Route::resources([
            'donation' => DonationController::class,
            'expense' => ExpenseController::class
        ]);
    });

    // Not Found:
    Route::fallback(function () {
        return view('errors.404');
    });
});

require __DIR__ . '/auth.php';
