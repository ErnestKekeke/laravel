<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

use App\Mail\myappMail;
use Illuminate\Support\Facades\Mail;

Route::post('/send-mail', function(Request $request){
    Mail::to("kekekeernest@gmail.com")->send(new myappMail(
        $request->username,
        $request->msg
    ));
    return "email sent successfully !";
})->name('send-mail');




Route::get('/', function(){
    return view('home'); 

})->name('home');


Route::get('/about', function(){
    return view('about');
})->name('about');


Route::get('/contact', function(){

    if (!Cookie::has('name')) {
        // Cookie does not exists
        Cookie::queue('name', 'Peter', 2); // time in minutes 
        Cookie::queue('age', '24', 2); // time in minutes 
    }
    return view('contact');
    // };
})->name('contact');

// when using form 
Route::post('/contact', function(Request $request){
    $name = null;
    $age = null;
    // request is not set cookie, is to check if
    // there is  already and existing cookies
    if ($request->hasCookie('name')) {
        // Cookie exists
        $name = $request->cookie('name');
        $age = $request->cookie('age');
    }
    return response()->json([
        "name" => $name,
        "age" => $age
    ]);
})->name('contact');

// Register .............................................
Route::post('/register', function(Request $request){

})->name('register');



