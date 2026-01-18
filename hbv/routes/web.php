<?php

use App\Http\Controllers\ClinicController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('clinic/', function () {
    return view('clinic');
})->name('clinic');

// Route::post('hbv', function () {
//     return view('hbv');
// })->name('hbv');

Route::get('hbv', [PatientController::class, 'index'])->name('hbv');
Route::get('hbv/{id}', [PatientController::class, 'show'])->name('hbv.show');
Route::get('hbv_edit/{id}', [PatientController::class, 'edit'])->name('hbv.edit');

Route::put('hbv_update/{id}', [PatientController::class, 'update'])->name('hbv.update');


Route::delete('hbv/{id}', [PatientController::class, 'destroy'])->name('hbv.destroy');

Route::get('clinic/patient', function () {
    return view('clinic.patient');
})->name('clinic.patient');

// Route::post('clinic/patient', [ClinicController::class, 'patient'])->name('clinic.patient');

Route::post('clinic/patient/register', [PatientController::class, 'register'])->name('patient.register');



Route::get('clinic/register', function () {
    return view('clinic.register');
})->name('clinic.register');

Route::post('clinic/register', [ClinicController::class, 'register'])->name('clinic.register');

Route::get('clinic/login', function () {
    return view('clinic.login');
})->name('clinic.login');

Route::post('clinic/login', [ClinicController::class, 'login'])->name('clinic.login');

Route::post('clinic/login', [ClinicController::class, 'login'])->name('clinic.login');

Route::post('/logout', [ClinicController::class, 'logout'])->name('logout');

