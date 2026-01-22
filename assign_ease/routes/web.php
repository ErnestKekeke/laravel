<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LecturerController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Student Routes
Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/assignments', [StudentController::class, 'assignments'])->name('assignments');
    Route::get('/assignments/{id}', [StudentController::class, 'showAssignment'])->name('assignment.show');
    Route::post('/assignments/{id}/submit', [StudentController::class, 'submitAssignment'])->name('assignment.submit');
    Route::get('/submissions', [StudentController::class, 'submissions'])->name('submissions');
});

// Lecturer Routes
Route::middleware(['auth'])->prefix('lecturer')->name('lecturer.')->group(function () {
    Route::get('/dashboard', [LecturerController::class, 'dashboard'])->name('dashboard');
    Route::get('/assignments', [LecturerController::class, 'assignments'])->name('assignments');
    Route::get('/create-assignment', [LecturerController::class, 'createAssignment'])->name('create-assignment');
    Route::post('/create-assignment', [LecturerController::class, 'storeAssignment'])->name('assignment.store');
    Route::get('/assignments/{id}', [LecturerController::class, 'showAssignment'])->name('assignment.show');
    Route::get('/submissions/{id}/download', [LecturerController::class, 'downloadSubmission'])->name('submission.download');
    Route::post('/submissions/{id}/grade', [LecturerController::class, 'gradeSubmission'])->name('submission.grade');
});