<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;

Route::get('/', function () {
    return view('home');
});

// use App\Mail\appMail;
// use Illuminate\Support\Facades\Mail;

// Route::get('/sendmail', function(){
//     Mail::to("ktektechnologies@gmail.com")->send(new appMail());
//     return "email sent successfully !";
// });


// Route::get('/book', function(){
//     $post = Post::create([
//     'title' => 'Chapter 1',
//     'content' => 'Post content here...',
//     'book_id' => 2,
//         ]);

// });