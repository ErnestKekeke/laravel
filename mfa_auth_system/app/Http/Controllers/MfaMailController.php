<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\mfaMail;
// use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Exception;

class MfaMailController extends Controller
{
    //...........................................................
    public function otpMailReg(){

        // cache()->put('otp', 1234, now()->addSeconds(50));
    
        $lr = "registration";
        $fullname = session('name');
        $phone = session('phone');
        $email = session('email');
        $userid = session('userid');
        $company = session('company');
        $password = session('password');

        // return response()->json(
        //         ["msg"=>"from otpMailReg",
        //         "name"=>$fullname,
        //         "phone"=>$phone,
        //         "email"=>$email,
        //         "userid"=>$userid,
        //         "company"=>$company,
        //         "password"=>$password,
        //         ]
        // );

        
        if (!$email) {
            return redirect('/register?error= error! invalid request resubmit form');
        }

        // return response()->json(
        //         ["name"=>$fullname,
        //         "phone"=>$phone,
        //         "email"=>$email,
        //         "userid"=>$userid,
        //         "password"=>$password,]
        // );


        if (!cache()->has('otp_'.$email)) {
            $otpExpireTime = 120;
            $otp = CheckController::generateSecureAlphanumeric();

            // $otpEmail = 'otp_'.$email;

            // $cookieOtpEmail = new Cookie('otp_email', $otpEmail, time() + $otpExpireTime);
            // cookie()->queue( $cookieOtpEmail);

            cache()->put('otp_'.$email, $otp, now()->addSeconds($otpExpireTime));
            cache()->put('fullname', $fullname, now()->addSeconds($otpExpireTime + 1));
            cache()->put('email', $email, now()->addSeconds($otpExpireTime + 1));
            cache()->put('phone', $phone, now()->addSeconds($otpExpireTime + 1));
            cache()->put('userid', $userid, now()->addSeconds($otpExpireTime + 1));
            cache()->put('company', $company, now()->addSeconds($otpExpireTime + 1));
            cache()->put('password', $password, now()->addSeconds($otpExpireTime + 1));

            try {
                Mail::to($email)
                    ->send(new mfaMail($fullname, $otp, $lr));
                // return "email sent successfully !";
                return redirect('/register')->with([
                    'email'=>$email,
                    'otp_state'=>false,
                ]);

            } catch (Exception $e) {
                cache()->forget('otp_'.$email);
                cache()->forget('fullname');
                cache()->forget('email');
                cache()->forget('phone');
                cache()->forget('userid');
                cache()->forget('company');
                cache()->forget('password');
                
                Log::error('Mail failed: ' . $e->getMessage());
                // return "Email sending failed!";
                // return "Email sending failed!" . $e->getMessage();
                return redirect('/register?error= error! failed to send email!' . $e->getMessage());
            }
            // cache exists
        }

        // return when code otp is already generated 
        return redirect('/register')->with([
            'email'=>$email,
            'otp_state'=>true,
        ]);
        
        // return redirect('/test');
        // return "Hello: ".cache()->get('otp_'.$email);



        // try {
        //     Mail::to("kekekeernest@gmail.com")
        //         ->send(new mfaMail($fullname, $otp, $lr));
        //     return "email sent successfully !";
        // } catch (Exception $e) {
        //     Log::error('Mail failed: ' . $e->getMessage());
        //     // return "Email sending failed!";
        //     return "Email sending failed!" . $e->getMessage();
        // }
    }



    // ..............................................................
        public function otpMailLogin(){

        // cache()->put('otp', 1234, now()->addSeconds(50));
    
        $lr = "login";
        $email = session('email');
        $userid = session('userid');
        $password = session('password');

        // return response()->json(
        //         ["email"=>$email,
        //         "userid"=>$userid,
        //         "password"=>$password]
        // );
 
        if (!$email) {
            // return redirect('/?error= error! invalid userid or email request re-login');
            return redirect('/')->with(['error'=>"error! invalid userid or email request re-login"]);
        }

        // return response()->json(
        //         ["email"=>$email,
        //         "userid"=>$userid,
        //         "password"=>$password]
        // );


        if (!cache()->has('otp_'.$email)) {
            $otpExpireTime = 120;
            $otp = CheckController::generateSecureAlphanumeric();

            cache()->put('otp_'.$email, $otp, now()->addSeconds($otpExpireTime));
            cache()->put('email', $email, now()->addSeconds($otpExpireTime + 1));
            cache()->put('userid', $userid, now()->addSeconds($otpExpireTime + 1));
            cache()->put('password', $password, now()->addSeconds($otpExpireTime + 1));

            try {
                Mail::to($email)
                    ->send(new mfaMail("", $otp, $lr));
                // return "email sent successfully !";

                return redirect('/')->with([
                    'email'=>$email,
                    'otp_state'=>false,
                ]);

            } catch (Exception $e) {
                Log::error('Mail failed: ' . $e->getMessage());
                // return "Email sending failed!";
                // return "Email sending failed!" . $e->getMessage();
                // return redirect('/?error= error! failed to send email!' . $e->getMessage());
                return redirect('/')->with(['error'=>"error! failed to send email!" . $e->getMessage()]);
            }
            // cache exists
        }

        // return when code otp is already generated 
        return redirect('/')->with([
            'email'=>$email,
            'otp_state'=>true,
        ]);
        
        // return redirect('/test');
        // return "Hello: ".cache()->get('otp_'.$email);



        // try {
        //     Mail::to("kekekeernest@gmail.com")
        //         ->send(new mfaMail($fullname, $otp, $lr));
        //     return "email sent successfully !";
        // } catch (Exception $e) {
        //     Log::error('Mail failed: ' . $e->getMessage());
        //     // return "Email sending failed!";
        //     return "Email sending failed!" . $e->getMessage();
        // }
    }
}
