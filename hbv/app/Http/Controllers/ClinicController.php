<?php

namespace App\Http\Controllers;
use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\CheckController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class ClinicController extends Controller
{
    public function register(Request $request){ 
       $request->validate([
            'logo'            => 'required|image|mimes:png|max:200',
            'clinic_id'       => 'required|numeric|between:1000,9999|unique:clinics,clinic_id',
            'clinic_name'     => 'required|string|min:3|max:40|unique:clinics,clinic_name',
            'clinic_type'     => 'required|in:general,dental,diagnostic,specialty,pediatric,surgical,maternity,mental_health,rehab,community,alternative',
            'reg_no'          => 'required|string|min:5|max:25|unique:clinics,reg_no',
            'lic_issue_dt'    => 'required|date|before_or_equal:today',
            'accred_status'   => 'required|in:none,pending,accredited',
            'med_dir'         => 'required|string|max:255',

            'email'           => 'required|email|unique:clinics,email',
            'contact_no'      => 'required|string|max:20',
            'address'         => 'required|string|min:5|max:50',

            'country'         => 'required|string|min:2|max:50',
            'state'           => 'required|string|min:2|max:50',
            'city'            => 'required|string|min:2|max:50',

            'password'        => 'required|confirmed|min:6',
        ]);

            // Optional: sanitize other inputs
            $clinicId = trim(strip_tags($request->clinic_id));
            $clinicId = CheckController::clinic_id($clinicId);      

            $clinicName = trim(strip_tags($request->clinic_name));
            $clinicName =  CheckController::name($clinicName);

            $regNo = strtolower(trim(strip_tags($request->reg_no)));
            $regNo = CheckController::reg_no($regNo);

            $medDir = trim(strip_tags($request->med_dir));
            $medDir = CheckController::name($medDir);

            $email   = strtolower(trim(strip_tags($request->email)));
            $email = CheckController::email($email);

            $contactNo   = trim(strip_tags($request->contact_no));
            $contactNo = CheckController::tel($contactNo);

            $address = trim(strip_tags($request->address));
            $password = trim(strip_tags($request->password));
            $password = CheckController::password($password);

            $clinicType  = trim(strip_tags($request->clinic_type));
            $licIssueDt = trim(strip_tags($request->lic_issue_dt));
            $accredStatus= trim(strip_tags($request->accred_status));
            $country = trim(strip_tags($request->country));
            $state   = trim(strip_tags($request->state));
            $city    = trim(strip_tags($request->city));
        // Check for null values and abort if found
        if (!$clinicId) return redirect('/clinic/register')->with(['error'=>"invalid: Clinic ID",]);
        if (!$clinicName) return redirect('/clinic/register')->with(['error'=>"invalid: Clinic Name",]);
        if (!$regNo) return redirect('/clinic/register')->with(['error'=>"invalid: Clinic Registration Number",]);
        if (!$medDir ) return redirect('/clinic/register')->with(['error'=>"invalid: Medical Director Name",]);
        if (!$email) return redirect('/clinic/register')->with(['error'=>"invalid: email address",]);
        if (!$contactNo) return redirect('/clinic/register')->with(['error'=>"invalid: Contact Number",]);
        if (!$address) return redirect('/clinic/register')->with(['error'=>"invalid: Address not accepted",]);
        if (!$password) return redirect('/clinic/register')->with(['error'=>"invalid: password must contain at least 1 digit",]);
        
        $logo = $request->logo;
        if(!$logo) return redirect('/clinic/register')->with(['error' => 'Please upload a clinic logo']);
        $logoName = $clinicId . '.' . $logo->extension();

        $clinicData = [
            'logo_name'            =>  $logoName,
            'clinic_id'            =>  $clinicId,
            'clinic_name'          =>  $clinicName,
            'clinic_type'          =>  $clinicType ,
            'registration_no'      =>  $regNo,
            'license_issue_date'   =>  $licIssueDt,
            'accreditation_status' =>  $accredStatus,
            'medical_director'     =>  $medDir,
            
            'email'                => $email,
            'contact_no'           => $contactNo,
            'address'              => $address,
            
            'country'              => $country,
            'state'                => $state,
            'city'                 => $city,
            
            'password'             => $password, 
        ];

        // return response()->json($clinicData);    


        $clinic = Clinic::updateOrCreate(
            ['reg_no' => $regNo], // lookup key
            [
                'clinic_id'     => $clinicId,
                'clinic_name'   => $clinicName,
                'clinic_type'   => $clinicType,
                'lic_issue_dt'  => $licIssueDt,
                'accred_status' => $accredStatus,
                'med_dir'       => $medDir,
                'email'         => $email,
                'contact_no'    => $contactNo,
                'address'       => $address,
                'country'       => $country,
                'state'         => $state,
                'city'          => $city,
                'password'      => Hash::make($password), // important
            ]
        );
        if ($clinic->wasRecentlyCreated) {
            $logo->storeAs( 'logos', $logoName,'public'); // save logo
            return redirect('/clinic/register')->with(['success'=>"Clinic: ". $clinic->clinic_name . " is newly Successfully Added",]);
        } else {
            return redirect('/clinic/register')->with(['info'=>"Clinic: ". $clinic->clinic_name . " is already Found on our Record",]);
        }
        return redirect('/clinic/register')->with(['error'=>"unable to add hospital, maybe server error !",]);
    }


    //...........................................
    function login(Request $request){

       $request->validate([
            'clinic_id'       => 'required|numeric|between:1000,9999',
            'reg_no'          => 'required|string|min:5|max:25',
            'password'        => 'required|min:6',
        ]);
        // Optional: sanitize other inputs
        $clinicId = trim(strip_tags($request->clinic_id));
        $clinicId = CheckController::clinic_id($clinicId);      

        $regNo = strtolower(trim(strip_tags($request->reg_no)));
        $regNo = CheckController::reg_no($regNo);

        $password = trim(strip_tags($request->password));

        // Check for null values and abort if found
        if (!$clinicId) return redirect('/clinic/login')->with(['error'=>"invalid: Clinic ID",]);
        if (!$regNo) return redirect('/clinic/login')->with(['error'=>"invalid: Clinic Registration Number",]);

        $clinic = Clinic::where(['reg_no' => $regNo,'clinic_id' => $clinicId])->first();
        if (!$clinic ) return redirect('/clinic/login')
            ->with(['error'=>$regNo.'  |id:'.$clinicId.": No Record found! or invalid match RegNo & ID"]);

        // $isLogin = Auth::attempt(['reg_no'=>$regNo,'clinic_id'=>$clinicId, 'password'=> $password]); // 
        $isLogin = Auth::guard('clinic')->attempt([
            'reg_no' => $regNo,
            'clinic_id' => $clinicId,
            'password'=> $password
        ]);

        Auth::guard('clinic')->user();
        // $clinic = Auth::guard('clinic')->user();
        // return "Login details: " . $clinic->clinic_name;

        if($isLogin){
            return redirect('/clinic')->with(["success"=>Auth::guard('clinic')->user()->clinic_name. ", you login successfully!"]);
        }

        return redirect('/clinic/login')->with(['error'=>"failed to login"]);
    }

    //................................................

    function patient(Request $request){
        return "patient form";
    }
 

    //................................................
    function logout(){
        session()->invalidate();          // clear session
        session()->regenerateToken();     // prevent CSRF attacks
        Auth::logout();  
        Auth::guard('clinic')->logout(); // logs out the clinic
        return redirect('/clinic/login')->with('success', 'You have been logged out.');
    }
}
