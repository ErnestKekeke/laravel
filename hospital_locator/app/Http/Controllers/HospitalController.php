<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;
use App\Http\Controllers\CheckController;

class HospitalController extends Controller
{
    /**
     * Display a listing of hospitals.
     */
    public function index()
    {
        $hospitals = Hospital::orderBy('hospital_name')->get();

        // return view('hospital.index', compact('hospitals'));
        // or API:
        return response()->json($hospitals);
    }

    /**
     * Display the specified hospital.
     *
     * @param  string  $id
     */
    public function show($id)
    {
        // method 1 ........................................
        $hospital = Hospital::where('id', $id)->firstOrFail();
        // return view('hospital.show', compact('hospital'));
        return response()->json($hospital);    // or API:

        // // method 2 ....................................
        // $hospital = Hospital::where('id', $id)->first();
        // if (!$hospital) {
        //     return response()->json([
        //         'status'  => false,
        //         'message' => 'no such id',
        //     ], 404);
        // }

        // return response()->json([
        //     'status' => true,
        //     'data'   => $hospital,
        // ]);
        // return response()->json($hospital);   
    }


    //........................................
    public function hospital(Request $request){
        $id = $request->query('hospital-id');
        // return $id;

        $hospital = Hospital::where('id', $id)->firstOrFail();
        // return response()->json($hospital);   
        return view('hospital', compact('hospital'));
    }

    //.........................................
    public function register(Request $request)
    {
        // Validate request
        $request->validate([
            'logo'              => 'required|image|mimes:png|max:200',
            'hospital_name'     => 'required|string|min:3|max:100|unique:hospitals,hospital_name',
            'hospital_type'     => 'required|in:general,specialty,teaching,tertiary,community,pediatric,maternity,psychiatric,rehabilitation,surgical,diagnostic,dental',
            'reg_no'            => 'required|string|min:5|max:25|unique:hospitals,reg_no',
            'lic_issue_dt'      => 'required|date|before_or_equal:today',
            'accred_status'     => 'required|in:none,pending,accredited',
            'med_dir'           => 'required|string|max:255',
            'ownership'         => 'required|in:government,private,charitable',
            'beds'              => 'required|integer|min:0',
            'email'             => 'required|email|unique:hospitals,email',
            'contact_no'        => 'required|string|max:20',
            'address'           => 'required|string|min:5|max:255',
            'country'           => 'required|string|min:2|max:50',
            'state'             => 'required|string|min:2|max:50',
            'city'              => 'required|string|min:2|max:50',
            'zip_code'          => 'required|string|min:3|max:15',
            'latitude'          => ['required', 'regex:/^(\+|-)?(?:90(?:\.0+)?|[0-8]?\d(?:\.\d+)?)$/'],
            'longitude'         => ['required', 'regex:/^(\+|-)?(?:180(?:\.0+)?|1[0-7]\d(?:\.\d+)?|0?\d{1,2}(?:\.\d+)?)$/'],
        ]);

        // Sanitize inputs using CheckController
        $hospitalName = CheckController::name(trim(strip_tags($request->hospital_name)));
        $regNo        = CheckController::reg_no(strtolower(trim(strip_tags($request->reg_no))));
        $medDir       = CheckController::name(trim(strip_tags($request->med_dir)));
        $email        = CheckController::email(strtolower(trim(strip_tags($request->email))));
        $contactNo    = CheckController::tel(trim(strip_tags($request->contact_no)));
        $address      = trim(strip_tags($request->address));
        $zipCode      = CheckController::zipcode(trim(strip_tags($request->zip_code)));
        $beds         = CheckController::bed(trim($request->beds));
        $latitude     = CheckController::latitude(trim($request->latitude));
        $longitude    = CheckController::longitude(trim($request->longitude));

        if (!$hospitalName) return back()->with('error', 'Invalid: Hospital Name');
        if (!$regNo) return back()->with('error', 'Invalid: Registration Number');
        if (!$medDir) return back()->with('error', 'Invalid: Medical Director');
        if (!$email) return back()->with('error', 'Invalid: Email');
        if (!$contactNo) return back()->with('error', 'Invalid: Contact Number');
        if (!$address) return back()->with('error', 'Invalid: Address');
        if (!$zipCode) return back()->with('error', 'Invalid: Zip-Code');
        if ($beds === false) return back()->with('error', 'Invalid: Number of Beds');
        if ($latitude === false) return back()->with('error', 'Invalid: Latitude');
        if ($longitude === false) return back()->with('error', 'Invalid: Longitude');

        // Handle logo upload
        $logo = $request->file('logo');
        if (!$logo) return back()->with('error', 'Please upload a hospital logo');

        // Create a unique file name
        $logoName = strtolower(str_replace(' ', '_', $hospitalName)) . '.' . $logo->extension();

        // Store the file in storage/app/public/logos
        $logoPath = $logo->storeAs('logos', $logoName, 'public');

        $hospitalData = [
            'logo_path'            => $logoPath,            // stored file path
            'hospital_name'        => $hospitalName,
            'hospital_type'        => $request->hospital_type,
            'reg_no'               => $regNo,
            'lic_issue_dt'         => $request->lic_issue_dt,
            'accred_status'        => $request->accred_status,
            'medical_director'     => $medDir,
            'ownership'            => $request->ownership,
            'beds'                 => $beds,
            
            'email'                => $email,
            'contact_no'           => $contactNo,
            'address'              => $address,
            
            'country'              => $request->country,
            'state'                => $request->state,
            'city'                 => $request->city,
            'zipcode'              => $request->zip_code,
            
            'latitude'             => $latitude,
            'longitude'            => $longitude,
        ];

        
        // return as JSON for debugging
        // return response()->json($hospitalData);

        // Save or update hospital
        $hospital = Hospital::updateOrCreate(
            ['reg_no' => $regNo],
            [
                'hospital_name' => $hospitalName,
                'hospital_type' => $request->hospital_type,
                'lic_issue_dt'  => $request->lic_issue_dt,
                'accred_status' => $request->accred_status,
                'med_dir'       => $medDir,
                'ownership'     => $request->ownership,
                'beds'          => $beds,
                'email'         => $email,
                'contact_no'    => $contactNo,
                'address'       => $address,
                'country'       => $request->country,
                'state'         => $request->state,
                'city'          => $request->city,
                'zipcode'       => $request->zip_code,
                'latitude'      => $latitude,
                'longitude'     => $longitude,
                'logo_path'     => $logoPath, // updated field
            ]
        );

        $message = $hospital->wasRecentlyCreated
            ? "Hospital {$hospital->hospital_name} registered successfully"
            : "Hospital {$hospital->hospital_name} updated successfully";

        return back()->with('success', $message);
    }
}
