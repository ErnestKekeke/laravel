<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\MfaMailController;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Cache;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::post('/admin', [AdminController::class, 'allUsers'])->name('admin.allusers');
Route::put('/admin/password/{email}', [AdminController::class, 'changePassword'])->name('admin.changepassword');
Route::delete('/admin/delete/{email}', [AdminController::class, 'delete'])->name('admin.delete');
Route::post('/admin/close', [AdminController::class, 'close'])->name('admin.close');


Route::get('/register', function(){
    return view('register');
})->name('register');

Route::post('/register', [UserController::class, 'preuser']
)->name('register.user');

Route::post('/register/create', [UserController::class, 'create']
)->name('register.create');

Route::post('/login', [UserController::class, 'prelogin']
)->name('login.prelogin');

Route::post('/login/login', [UserController::class, 'login']
)->name('login.login');

Route::post('/login/company', [UserController::class, 'company']
)->name('login.company');

Route::post('/logout', [UserController::class, 'logout']
)->name('logout');


//.......................................

//.......................................
// use Illuminate\Support\Facades\Mail;
// use App\Mail\mfaMail;
// // use Illuminate\Support\Facades\Cache;
// use Illuminate\Support\Facades\Log;


Route::get('/sendmailotp_reg', [MfaMailController::class, 'otpMailReg'] );
Route::get('/sendmailotp_login', [MfaMailController::class, 'otpMailLogin'] );


// Route::get('/sendotp', function(Request $request){
//     $fullname = "Ernest Kekeke";
//     $otp = random_int(100000, 999999); // 6-digit OTP
//     // $lr = "login";
//     $lr = "registration";
//     try {
//         Mail::to("kekekeernest@gmail.com")
//             ->send(new mfaMail($fullname, $otp, $lr));
//         return "email sent successfully !";
//     } catch (Exception $e) {
//         Log::error('Mail failed: ' . $e->getMessage());
//         // return "Email sending failed!";
//         return "Email sending failed!" . $e->getMessage();
//     }
// });
    



//.........................
// Route::get('/test/name/{input}', [CheckController::class, 'name']);
// Route::get('/test/tel/{input}', [CheckController::class, 'tel']);
// Route::get('/test/email/{input}', [CheckController::class, 'email']);
// Route::get('/test/password/{input}', [CheckController::class, 'password']);
// Route::get('/test/userid/{input}', [CheckController::class, 'userid']);
// Route::get('/test/alphanumeric', [CheckController::class, 'generateSecureAlphanumeric']);

Route::get('/test', function(){
    return "Hello from Test!!!";
    // $email = "kekekeernest@gmail.com";
    // // return "Hello test: ".cache()->get('otp_'.$email);
    // return view('test');
});


//.........................
use Illuminate\Support\Facades\Cache;

// Route::get('/otp', function(){


//     $otp = null;

//     if (!Cache::has('otp')) {
//         // cache does not exists
//         $otp = random_int(100000, 999999); // 6-digit OTP

//         // Store OTP for 3 minutes (180 seconds)
//         Cache::put('otp', $otp, now()->addMinutes(3));
//     }

//     if (Cache::has('otp')) {
//         // cache exists
//         // get stored OTP 
//         $otp = Cache::get('otp');
//     }

//     return $otp;
//     //.............

// } );

