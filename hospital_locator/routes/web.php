<?php

use App\Http\Controllers\HospitalController;
use App\Models\Hospital;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/hospital_register', function () {
    return view('hospital_register');
})->name('hospital_register');

Route::post('/hospital_register', [HospitalController::class, 'register'])->name('hospital_register.register');

Route::get('/hospital', [HospitalController::class, 'hospital'])->name('hospital');


// Route::get('/api/hospitals', [HospitalController::class, 'index'])->name('hospital.index');
// Route::get('/api/hospitals/{id}', [HospitalController::class, 'show'])->name('hospital.show'); 




