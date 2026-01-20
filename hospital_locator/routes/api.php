<?php
use App\Http\Controllers\HospitalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/hospitals', [HospitalController::class, 'index'])->name('hospital.index');
Route::get('/hospitals/{id}', [HospitalController::class, 'show'])->name('hospital.show');