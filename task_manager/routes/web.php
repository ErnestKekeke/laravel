<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return "Welcome to Home Page";
});


// Route::get('/tasks/index', function(){
//     return view('tasks.index');
// })->name('tasks.index');


Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

Route::post('/tasks/reorder', [TaskController::class, 'reorder']);


Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');

Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');


Route::post('/tasks/store', [TaskController::class, 'store'])->name('tasks.store');

Route::put('/tasks/update/{task}', [TaskController::class, 'update'])->name('tasks.update');

Route::delete('/tasks/destroy/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');




    // public function index()
    // {
    //     $posts = Post::all();

    //     return view('posts.index', compact('posts'));
    // }
