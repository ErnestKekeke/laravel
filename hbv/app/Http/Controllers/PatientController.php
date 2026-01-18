<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PatientController extends Controller
{

    /**
     * Display a listing of patients.
     */
    public function index()
    {
        $patients = Patient::where('clinic_id', Auth::guard('clinic')->user()->clinic_id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('patients.index', compact('patients'));
    }


//...............................................................
    public function show($id)
    {
        $patient = Patient::where('id', $id)
            ->where('clinic_id', Auth::guard('clinic')->user()->clinic_id)
            ->firstOrFail();

        return view('patients.show', compact('patient'));
    }


//.....................................................................
    public function edit($id)
    {
        $patient = Patient::where('id', $id)
            ->where('clinic_id', Auth::guard('clinic')->user()->clinic_id)
            ->firstOrFail();

        return view('patients.edit', compact('patient'));
    }    
//...............................................................
    public function register(Request $request){
        $request->validate([
            // Personal Information
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:male,female',
            'patient_id' => 'nullable|string|unique:patients,patient_id',
            'patient_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            
            // Contact Information
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string',
            'country' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            
            // Laboratory Results
            'test_date' => 'required|date',
            'hbsag' => 'required|in:positive,negative,pending',
            'anti_hbs' => 'nullable|in:positive,negative,pending',
            'hbeag' => 'nullable|in:positive,negative,pending',
            'viral_load' => 'nullable|integer|min:0',
            'alt_level' => 'nullable|integer|min:0',
            'ast_level' => 'nullable|integer|min:0',
            'platelet_count' => 'nullable|integer|min:0',
            'lab_notes' => 'nullable|string',
            
            // Treatment Information
            'diagnosis_type' => 'required|in:acute,chronic,carrier,resolved',
            'treatment_status' => 'required|in:on_treatment,not_started,monitoring,completed',
            'vaccination_status' => 'required|in:fully_vaccinated,partially_vaccinated,not_vaccinated',
            'prescribed_medication' => 'nullable|string',
            'next_appointment' => 'nullable|date|after:today',
            'doctor_name' => 'nullable|string|max:255',
            'treatment_notes' => 'nullable|string',
        ]);


        $clinic_id = Auth::guard('clinic')->user()->clinic_id;
        $patientId = trim(strip_tags($request->patient_id));
        if(!$patientId) $patientId = Patient::generatePatientId($clinic_id);

        // Sanitize Personal Information
        $firstName = trim(strip_tags($request->first_name));
        $lastName = trim(strip_tags($request->last_name));
        $middleName = $request->middle_name ? trim(strip_tags($request->middle_name)) : null;

        $gender = trim(strip_tags($request->gender));
        $dateOfBirth = $request->date_of_birth;

        // Sanitize Contact Information
        $phone = trim(strip_tags($request->phone));
        $email = $request->email ? trim(strip_tags($request->email)) : null;
        $address = trim(strip_tags($request->address));
        $country = trim(strip_tags($request->country));
        $state = trim(strip_tags($request->state));
        $city = trim(strip_tags($request->city));
        $postalCode = $request->postal_code ? trim(strip_tags($request->postal_code)) : null;

        // Sanitize Laboratory Results
        $testDate = $request->test_date;
        $hbsag = trim(strip_tags($request->hbsag));
        $antiHbs = $request->anti_hbs ? trim(strip_tags($request->anti_hbs)) : null;
        $hbeag = $request->hbeag ? trim(strip_tags($request->hbeag)) : null;
        $viralLoad = $request->viral_load;
        $altLevel = $request->alt_level;
        $astLevel = $request->ast_level;
        $plateletCount = $request->platelet_count;
        $labNotes = $request->lab_notes ? trim(strip_tags($request->lab_notes)) : null;

        // Sanitize Treatment Information
        $diagnosisType = trim(strip_tags($request->diagnosis_type));
        $treatmentStatus = trim(strip_tags($request->treatment_status));
        $vaccinationStatus = trim(strip_tags($request->vaccination_status));
        $prescribedMedication = $request->prescribed_medication ? trim(strip_tags($request->prescribed_medication)) : null;
        $nextAppointment = $request->next_appointment;
        $doctorName = $request->doctor_name ? trim(strip_tags($request->doctor_name)) : null;
        $treatmentNotes = $request->treatment_notes ? trim(strip_tags($request->treatment_notes)) : null;

        // Handle patient image upload
        $patientImagePath = null;
        if ($request->hasFile('patient_image')) {
            // $patientImagePath = $request->file('patient_image')->store('patient_images', 'public');
            // $patientImage = $patientId . '.' . $request->patient_image->extension();
            $patientImage = $request->patient_image;
            $imgExt =  $patientImage->extension();
            $patientImagePath = $patientImage->storeAs( 'patient_images', $patientId . '.' . $imgExt,'public'); // save logo
        }

        // Save to database
        $patient = new Patient();
        $patient->clinic_id  =  $clinic_id;
        $patient->patient_id = $patientId;
        $patient->first_name = $firstName;
        $patient->last_name = $lastName;
        $patient->middle_name = $middleName;
        $patient->date_of_birth = $dateOfBirth;
        $patient->gender = $gender;
        $patient->photo_path = $patientImagePath;

        $patient->phone = $phone;
        $patient->email = $email;
        $patient->address = $address;
        $patient->country = $country;
        $patient->state = $state;
        $patient->city = $city;
        $patient->postal_code = $postalCode;

        $patient->test_date = $testDate;
        $patient->hbsag = $hbsag;
        $patient->anti_hbs = $antiHbs;
        $patient->hbeag = $hbeag;
        $patient->viral_load = $viralLoad;
        $patient->alt_level = $altLevel;
        $patient->ast_level = $astLevel;
        $patient->platelet_count = $plateletCount;
        $patient->lab_notes = $labNotes;

        $patient->diagnosis_type = $diagnosisType;
        $patient->treatment_status = $treatmentStatus;
        $patient->vaccination_status = $vaccinationStatus;
        $patient->prescribed_medication = $prescribedMedication;
        $patient->next_appointment = $nextAppointment;
        $patient->doctor_name = $doctorName;
        $patient->treatment_notes = $treatmentNotes;

        try {
            // return response()->json([
            //     'message' => 'Patient registered successfully',
            //     'patient' => $patient
            // ], 201);

            $patient->save();
            return redirect('clinic/patient/')->with(['success'=>"Patient ID: " . $patient->patient_id . " is newly Successfully Added",]);
        } catch (\Exception $e) {
            // Log::error('Patient registration error: ' . $e->getMessage());
            // return response()->json([
            //     'message' => 'Failed to register patient',
            //     'error' => $e->getMessage()
            // ], 500);
            return redirect('clinic/patient/')->with(['error'=>"unable to register patient".$e->getMessage()]);
        }

    }

    // ..............................................

        /**
     * Update the specified patient in storage.
     */
    public function update(Request $request, $id)
    {
        $patient = Patient::where('id', $id)
            ->where('clinic_id', Auth::guard('clinic')->user()->clinic_id)
            ->firstOrFail();

        // Validate the request
        $validated = $request->validate([
            // // Personal Information
            // 'first_name' => 'required|string|max:255',
            // 'last_name' => 'required|string|max:255',
            // 'middle_name' => 'nullable|string|max:255',
            // 'date_of_birth' => 'required|date|before:today',
            // 'gender' => 'required|in:male,female',
            // 'patient_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            
            // // Contact Information
            // 'phone' => 'required|string|max:20',
            // 'email' => 'nullable|email|max:255',
            // 'address' => 'required|string',
            // 'country' => 'required|string|max:100',
            // 'state' => 'required|string|max:100',
            // 'city' => 'required|string|max:100',
            // 'postal_code' => 'nullable|string|max:20',
            
            // Laboratory Results
            'test_date' => 'required|date',
            'hbsag' => 'required|in:positive,negative,pending',
            'anti_hbs' => 'nullable|in:positive,negative,pending',
            'hbeag' => 'nullable|in:positive,negative,pending',
            'viral_load' => 'nullable|integer|min:0',
            'alt_level' => 'nullable|integer|min:0',
            'ast_level' => 'nullable|integer|min:0',
            'platelet_count' => 'nullable|integer|min:0',
            'lab_notes' => 'nullable|string',
            
            // Treatment Information
            'diagnosis_type' => 'required|in:acute,chronic,carrier,resolved',
            'treatment_status' => 'required|in:on_treatment,not_started,monitoring,completed',
            'vaccination_status' => 'required|in:fully_vaccinated,partially_vaccinated,not_vaccinated',
            'prescribed_medication' => 'nullable|string',
            'next_appointment' => 'nullable|date|after:today',
            'doctor_name' => 'nullable|string|max:255',
            'treatment_notes' => 'nullable|string',
        ]);

        try {
            // Handle image upload
            // if ($request->hasFile('patient_image')) {
            //     // Delete old image if exists
            //     if ($patient->photo_path) {
            //         Storage::disk('public')->delete($patient->photo_path);
            //     }

            //     $image = $request->file('patient_image');
            //     $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            //     $imagePath = $image->storeAs('patient_photos', $imageName, 'public');
            //     $validated['photo_path'] = $imagePath;
            // }

            // Update the patient
            $patient->update($validated);

            // Redirect with success message
            return redirect()
                // ->route('patient.index')
                // ->with('success', 'Patient record deleted successfully!');
                ->route('hbv')
                ->with('success', 'Patient: ' . $patient->patient_id .' record updated successfully!');

            // return redirect('clinic/patient/')->with(['success'=>"Patient ID: " . $patient->patient_id . " is newly Successfully Added",]);

        } catch (\Exception $e) {
            // Log the error
            Log::error('Patient update error: ' . $e->getMessage());

            // Redirect back with error
            return redirect()
                // ->route('patient.index')
                // ->with('success', 'Patient record deleted successfully!');
                ->route('hbv')
                ->with('error',"Failed to update patient. Please try again. ".$e->getMessage());
            // return redirect('clinic/patient/')->with(['error'=>"Failed to update patient. Please try again. ".$e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        $patient = Patient::where('id', $id)
            ->where('clinic_id',  Auth::guard('clinic')->user()->clinic_id)
            ->firstOrFail();

        try {
            // Delete patient image if exists
            if ($patient->photo_path) {
                Storage::disk('public')->delete($patient->photo_path);
            }

            // Soft delete the patient
            $patient->delete();

            return redirect()
                // ->route('patient.index')
                // ->with('success', 'Patient record deleted successfully!');
                ->route('hbv')
                ->with('success', 'Patient record deleted successfully!');

        } catch (\Exception $e) {
            Log::error('Patient deletion error: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Failed to delete patient. Please try again.');
        }
    }
} 
