<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

use App\Mail\appMail;
use Illuminate\Support\Facades\Mail;

Route::get('/sendmail', function(){
    Mail::to("ktektechnologies@gmail.com")->send(new appMail());
    return "email sent successfully !";
});

