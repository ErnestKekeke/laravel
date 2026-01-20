<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharityController;

Route::get('/', [CharityController::class, 'home'])->name('home');
Route::get('/donate', [CharityController::class, 'donate'])->name('donate');
Route::post('/donate', [CharityController::class, 'processDonation'])->name('donate.process');
Route::get('/dashboard', [CharityController::class, 'dashboard'])->name('dashboard');