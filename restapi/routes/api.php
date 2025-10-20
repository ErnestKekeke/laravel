<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// get all posts...............................
Route::get('posts', [PostController::class, 'all_posts']);

// get a single post...........................
Route::get('posts/{id}', [PostController::class, 'single_post']);

// create a post...............................
Route::post('posts', [PostController::class, 'create_post'])->name('API_create_post');

// update a post...............................
Route::put('posts/{id}', [PostController::class, 'update_post'])->name('API_update_post');

// delete a post................................
Route::delete('posts/{id}', [PostController::class, 'delete_post'])->name('API_delete_post');
