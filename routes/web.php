<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DiagnosticController;
use App\Http\Controllers\ExpenseController;
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

    Route::get('/example', function() {
        return view('example');
    })->name('example.link');

    // User Access:
    Route::resources([
        'anamnesis' => MedHistoryController::class,
        'attendance' => AttendanceController::class,
        'diagnostic' => DiagnosticController::class,
        'record' => RecordController::class,
        'student' => StudentController::class,
        'regional' => RegionalController::class,
        'educational' => EducationalController::class,
    ]);
    Route::get('/studentapi/{id}', [StudentApiController::class, 'getStudentData']);
    Route::get('/sla', [StudentApiController::class, 'teste']);

    // Admin Access:
    Route::middleware(CheckAdmin::class)->group( function() {
        Route::get('/admin', function() {
            return view('forbidden');
        })->name('adminsla');

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
