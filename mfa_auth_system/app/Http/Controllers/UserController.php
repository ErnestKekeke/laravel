<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\CheckController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function preuser(Request $request){

        $request->validate([
            'firstname' => 'required|string|min:2|max:25',
            'lastname' => 'required|string|min:2|max:25',
            'phone' => 'required|string|min:5|max:15', // adjust as needed
            'email' => 'required|email|unique:users,email',
            'userid' => 'required|string|min:4|max:8|unique:users,userid', 
            'company' => 'required|string', 
            'password' => 'required|string|min:6|confirmed', // confirmed expects password_confirmation field
            'agree' => 'required|accepted', // must be checked
        ]);

        $firstname = strip_tags(trim($request->firstname));
        $firstname = ucwords(strtolower($firstname));

        $lastname = strip_tags(trim($request->lastname));
        $lastname = ucwords(strtolower($lastname));

        $phone = strip_tags(trim($request->phone));

        $email = strip_tags(trim($request->email));
        $email = strtolower($email);

        $userid = strip_tags(trim($request->userid));
        $userid   = strtolower($userid);
         
        $company = strip_tags(trim($request->company));
        $company  = strtolower($company);

        $password = strip_tags(trim($request->password));

        $firstname = CheckController::name($firstname);
        $lastname = CheckController::name($lastname);
        $phone = CheckController::tel($phone);
        $email = CheckController::email($email);
        $userid = CheckController::userid($userid);
        $company = CheckController::company($company);
        $password = CheckController::password($password);

        // Check for null values and abort if found
        if ($firstname === null) {
            return redirect()->to("/register?error=firstname not accepted, must be a minimum of 2 letter, and no numbers");
        }
        if ($lastname === null) {
            return redirect()->to("/register?error=lastname not accepted, must be a minimum of 2 letter, and no numbers");
        }
        if ($phone === null) {
            return redirect()->to("/register?error=phone number not accepted, must not contain letter, only digits");
        }
        if ($email === null) {
            return redirect()->to("/register?error=email not accepted, use a proper email format");
        }
        if ($userid === null) {
            return redirect()->to("/register?error=user ID invalid, must contain comapany prefix and a min:3 and max:6 digits");
        }
        if ($company === null) {
            return redirect()->to("/register?error=company is not registered or unavailable");
        }

        if (substr($userid, 0, 2) !== substr($company, 0, 2)) {
            return redirect()->to("/register?error=user ID does not match with company provided ID");
        }

        if ($password === null) {
            return redirect()->to("/register?error=password not accepted, must contain at least 1 digit, and a min of 6 characters");
        }


        $name = $firstname . " " . $lastname;
        // return response()->json(
        //     ["name"=>$name,
        //     "phone"=>$phone,
        //     "email"=>$email,
        //     "userid"=>$userid,
        //     "company"=>$company,
        //     "password"=>$password,
        //     ]
        // );

        return redirect('/sendmailotp_reg')->with([
            "name"=>$name,
            "phone"=>$phone,
            "email"=>$email,
            "userid"=>$userid,
            "company"=>$company,
            "password"=>$password,
        ]);

       
        // create a user object 
        // $user = new User;
        // $user->name = $name;
        // $user->phone = $phone;
        // $user->email = $email;
        // $user->userid = $userid;
        // $user->company = $company;
        // $user->password = $password;

        // return response()->json(["msg"=>var_dump($user)]);
    }


    //...........................................
    function create(Request $request){

        $otpconfirm = strip_tags(trim($request->otpconfirm));

        $fullname = Cache::get('fullname');
        $phone = Cache::get('phone');
        $userid = Cache::get('userid');
        $company = Cache::get('company');
        $password = Cache::get('password');
        $email = Cache::get('email');
        $otp = Cache::get('otp_'.$email);

        if (!$otp) {
        return redirect('/register?error= Code has expired!, try again');
        }

        if ($otp !=  $otpconfirm) {
        return redirect('/register?error= No Matching Code');
        }

        // return "user otpcomfirm: " . $otpconfirm . " otp: " . $otp;


        // $user = User::where('email', $email)->first();
        // if (!$user){
        //     return "user does not exist yet !";
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'userid' => $userid,
                'company' => $company,
                'name' => $fullname,  // Add this line
                'phone' => $phone,
                'password' => Hash::make($password)
            ]
        );

        // ..................................................   
      
        cache()->forget('otp_'.$email);
        cache()->forget('fullname');
        cache()->forget('email');
        cache()->forget('phone');
        cache()->forget('userid');
        cache()->forget('company');
        cache()->forget('password');

        if ($user->wasRecentlyCreated) {
            return redirect()->to('/')->with([
                'success' => "User: $email created successfully! Log in to your account."
            ]);
        } else {
            return redirect()->to('/')->with([
                'info' => "User: $email already exists. Please log in."
            ]);
        }
        // ..................................................   

        // }

        return redirect()->to('/')->with([
                'error' => "User: $email unable to create. Register a new user or Log into an existing account."
            ]);

        // return redirect()->to("/register?error= user: ". $email . " already exists, login or try a new user");

        // return "user: " . var_dump($user);
        
        // return response()->json(
        //     ["fullname"=>$fullname,
        //     "phone"=>$phone,
        //     "email"=>$email,
        //     "userid"=>$userid,
        //     "password"=>$password,
        //     "otp"=>$otp,
        //     "otpconfirm"=>$otpconfirm
        //     ]
        // );
    }

    //...........................................
    function prelogin(Request $request){

        $request->validate([
            'user_id_email' => 'required|string|min:4|',
            'password' => 'required|string|min:6|', // confirmed expects password_confirmation field
        ]);
        $user_id_email = strip_tags(trim($request->user_id_email));
        $user_id_email = strtolower($user_id_email);
        $password = strip_tags(trim($request->password));

        $email = CheckController::email($user_id_email);
        $userid = CheckController::userid($user_id_email);


        if ($userid === null && $email === null) return redirect('/')->with(["error"=>"user Email or ID invalid!"]);
        
        $user = null;
        $user = User::where('email', $email)->first();
        if(!$user){
            $user = User::where('userid', $userid)->first();
        }
        if (!$user) return redirect('/')->with(["error"=>"No User Record found!"]);
        // return "user: " . var_dump($user);

        $email = $user->email;

        if ($user && Hash::check($password, $user->password)) {  
            // cache()->forget('otp_'.$email);
            // cache()->forget('fullname');
            // cache()->forget('email');
            // cache()->forget('phone');
            // cache()->forget('userid');
            // cache()->forget('password');

            return redirect('/sendmailotp_login')->with([
                "email"=>$email,
                "userid"=>$userid,
                "password"=>$password,
            ]);
            
            return "user_id: " . $userid . ",  email: " . $email . ", password: " . $password;

        } 
        return redirect('/')->with(["error"=>"email or userid, does match with password!"]);
    }


    //................................................
    function login(Request $request){
        $otpconfirm = strip_tags(trim($request->otpconfirm));
        $userid = Cache::get('userid');
        $email = Cache::get('email');
        $password = Cache::get('password');
        $otp = Cache::get('otp_'.$email);

        if (!$otp) {
        // return redirect('/?error= Code has expired!, try again');
        return redirect('/')->with(["error"=>"Code has expired!, try again"]);
        }

        if ($otp !=  $otpconfirm) {
        // return redirect('/?error= No Matching Code');
        return redirect('/')->with(["error"=>"No Matching Code"]);
        }

        // $user = null;
        // $user = User::where('email', $email)->first();

        $isLogin = Auth::attempt(['email'=>$email, 'password'=> $password]); // 

        if($isLogin){
            // return " login: ".$user->email . " company : " . $user->company . " auth user: " . Auth::user()->name;
            return redirect('/')->with(["success"=>Auth::user()->name. ", you login successfully!!!"]);
        }
        return redirect('/')->with(["error"=>"failed to login successfully"]);
    }

    //................................................
    function logout(){
        Auth::logout();  
        session()->invalidate(); // when using normal session
        return redirect(route('home'));
    }


    //................................................
    function company(){
        $company = Auth::user()->company;
        $companyUrl = CheckController::gotoCompany($company);
        // return "company: " . $company . ", url: " . $companyURL;
        return redirect($companyUrl);
    }


}
