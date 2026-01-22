<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

// Public routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Protected routes - require login
Route::middleware('auth.check')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/report', [HomeController::class, 'store'])->name('report.store');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin only routes
Route::middleware('admin.check')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/report/{id}/update-status', [AdminController::class, 'updateStatus'])->name('admin.update.status');
});