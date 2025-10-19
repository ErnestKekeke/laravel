<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Usercontroller;

Route::get('/', function () {
    $user_id = isset(Auth::user()->id) ? Auth::user()->id : 0;
    $posts = Post::where('user_id',  $user_id)->get();  
    // $posts = Auth::check() ? Auth::user()->userPosts()->latest()->get() : [];
    return view('home', compact('posts'));
})->name('home');


Route::post('/register', [Usercontroller::class, 'register'])->name('register');
Route::post('/logout', [Usercontroller::class, 'logout'])->name('logout');
Route::post('/login', [Usercontroller::class, 'login'])->name('login');
Route::get('/edit_post/{post}', [PostController::class, 'editPost'])->name('edit_post');
Route::put('/update_post/{post}', [PostController::class, 'updatePost'])->name('update_post');
Route::delete('/delete_post/{post}', [PostController::class, 'deletePost'])->name('delete_post');
Route::post('/create_post', [PostController::class, 'createPost'])->name('create_post');

// Route::post('/create_post', function(){
//     return "New Post";
// })->name('create_post');

