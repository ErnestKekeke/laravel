<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('home');
})->name('home');


use App\Http\Controllers\CalculatorController;

Route::post('/calculator', [CalculatorController::class, 'cal'])->name('calculator.cal');
Route::get('/calculator', [CalculatorController::class, 'index'])->name('calculator.index');
Route::get('/calculator/last_val', [CalculatorController::class, 'last_val'])->name('calculator.last_val');
Route::put('/calculator/update_val', [CalculatorController::class, 'update_val'])
    ->name('calculator.update_val');

use Illuminate\Support\Facades\DB;

// Route::get('/create', function(){
//     // Insert
//     DB::table('users')->insert([
//         'name' => 'John Doe',
//         'email' => 'john@example.com',
//         'password' => bcrypt('password')
//     ]);
// return "Create successfully";
// })->name('create');


// Route::get('/create', function(){
//     // Insert
//     DB::table('calculators')->insert([
//         'value' => 2.74
//     ]);
// return "Create successfully";
// })->name('create');

use App\Models\Calculator;
Route::get('/create', function(){
    // Insert
    // $val = DB::table('calculators')->get();
    $val = Calculator::find(1);
  
    echo $val->value . "<br/>";
    echo $val->id;
return "Create successfully";
})->name('create');