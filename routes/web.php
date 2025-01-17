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

// Protected routes
Route::get('/admin/dashboard', [ProfessorController::class, 'dashboard'])->name('admin.dashboard');
Route::middleware(['auth:professor'])->group(function () {
    Route::prefix('professor')->name('professor.')->group(function () {
        Route::get('/dashboard', [ProfessorController::class, 'index'])->name('dashboard');
        Route::match(['get', 'post'], '/attendance/{division}', [ProfessorController::class, 'handleAttendance'])->name('attendance');
        Route::get('/monthly-attendance/{month}', [ProfessorController::class, 'monthlyAttendance'])->name('monthlyAttendance');
        Route::get('/overall-attendance', [ProfessorController::class, 'overallAttendance'])->name('overallAttendance');
    });
});
