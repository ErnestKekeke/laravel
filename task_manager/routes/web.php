<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


// Here is where you register web routes for your application. 


// Welcome landing page before entering the dashboard
Route::get('/', function() {
    return view('welcome');
});

// Task Dashboard & Drag-and-Drop Reordering
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/tasks/reorder', [TaskController::class, 'reorder']);

// Task Creation Form & Handler
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks/store', [TaskController::class, 'store'])->name('tasks.store');

// Task Editing & Update Handler
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/update/{task}', [TaskController::class, 'update'])->name('tasks.update');

// Task Deletion Route
Route::delete('/tasks/destroy/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');