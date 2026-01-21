<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

use Illuminate\Http\Request;

use Faker\Factory as Faker;

Route::get('/', function () {
    $faker = Faker::create();

    $user = [
        'name' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'bio' => $faker->text(100),
        'age' => $faker->numberBetween(1, 100),
        'birth_date' => $faker->date(),
        'is_active' => $faker->boolean,
    ];

    return response()->json($user);
})->name('home');

