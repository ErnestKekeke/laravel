<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class Usercontroller extends Controller
{
    // Login Method
    public function login(Request $request){
        $incomingFields = $request->validate([
            'loginname' => ['required'],
            'loginpassword' => ['required']
        ]);

        $isCorrect = Auth::attempt(['name'=>$incomingFields['loginname'],
                'password'=> $incomingFields['loginpassword']]); // store row info
        if($isCorrect){
            // return "Your are login"; 
            $request->session()->regenerate();  

            return redirect(Route('home')); 
             
        }

        // return  "id: " . Auth::user()->id . ", name: " . Auth::user()->name . ", 
        // email: " . Auth::user()->email;

        return redirect(Route('home'));
    }

    // Logout Method
    public function logout(){
        Auth::logout();  
        return redirect(Route('home'));
    }

    // Register Method
    public function register(Request $request){
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:20', Rule::unique('users', 'name')],
            'email'=> ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:100']
        ]);
        $incomingFields['password'] = bcrypt($incomingFields['password']);
        
        // User::create($incomingFields);
        // return "Registration Completed " . $incomingFields['password'];

        // To create an auto login was user is successfully registered
        $user = User::create($incomingFields);
        Auth::login($user); 

        // return redirect('/');
        return redirect(Route('home'));
    }
}
