<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/signup', [SignupController::class, 'index'])->name('signup');
Route::post('/signup', [SignupController::class, 'register'])->name('register');
Route::get('/setup-pin/{user}', [SignupController::class, 'showPinSetupForm'])->name('setup.pin');
Route::post('/setup-pin/{user}', [SignupController::class, 'setupPin']);
Route::get('/verify-pin', [LoginController::class, 'showPinVerificationForm'])->name('verify.pin');
Route::post('/verify-pin', [LoginController::class, 'verifyPin']);
Route::post(
    '/professor/send-monthly-report/{student}/{month}',
    [ProfessorController::class, 'sendMonthlyReport']
)
    ->name('professor.sendMonthlyReport');
// Protected routes


Route::middleware(['auth'])->group(function () {
    // Make sure this path matches your URL exactly
    Route::get('/my-attendance', [StudentController::class, 'viewMyAttendance'])->name('student.attendance');
});


Route::prefix('professor')->name('professor.')->group(function () {
    Route::get('/manage-students', [ProfessorController::class, 'manageStudents'])->name('manage-students');
    Route::get('/dashboard', [ProfessorController::class, 'index'])->name('dashboard');
    Route::get('/create-student', [ProfessorController::class, 'create'])->name('create');

    Route::get('/professor/overall-attendance', [ProfessorController::class, 'showOverallAttendance'])->name('professor.overallAttendance');
    Route::post('/store-student', [ProfessorController::class, 'store'])->name('store');
    Route::delete('/student/{id}', [ProfessorController::class, 'destroy'])->name('destroy');
    Route::match(['get', 'post'], '/attendance/{division}', [ProfessorController::class, 'handleAttendance'])->name('attendance');
    Route::get('/monthly-attendance/{month}', [ProfessorController::class, 'monthlyAttendance'])->name('monthlyAttendance');
    Route::get('/overall-attendance', [ProfessorController::class, 'overallAttendance'])->name('overallAttendance');
});
