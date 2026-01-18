<!DOCTYPE html>
<html lang="en">
<head>
    {{-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Update Patient - {{ $patient->first_name }} {{ $patient->last_name }}</title>
    <link rel="stylesheet" href="{{ asset('css/patient-edit.css') }}"> --}}


@include('layouts.meta')
@vite('resources/css/reset.css')
@vite('resources/css/patients/edit.css')
<title>Update Patient - {{ $patient->first_name }} {{ $patient->last_name }}</title>

</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <div class="header-content">
                <h1>Update Patient Information</h1>
                <p class="patient-info">{{ $patient->first_name }} {{ $patient->last_name }} - {{ $patient->patient_id }}</p>
            </div>
            <a href="{{ route('hbv.show', $patient->id) }}" class="btn-back">← Back to Details</a>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
        <div class="alert alert-success">
            <span class="alert-icon">✓</span>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-error">
            <span class="alert-icon">✕</span>
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('hbv.update', $patient->id) }}" method="POST" enctype="multipart/form-data" class="patient-form" id="patientUpdateForm">
        {{-- <form action="" method="POST" enctype="multipart/form-data" class="patient-form" id="patientUpdateForm"> --}}
            @csrf
            @method('PUT')

            <!-- Section 1: Laboratory Results -->
            <div class="form-section">
                <h2 class="section-title">
                    <span class="section-number">1</span>
                    Laboratory Results
                </h2>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="test_date">Date of Test <span class="required">*</span></label>
                        <input type="date" id="test_date" name="test_date" value="{{ old('test_date', $patient->test_date) }}" required>
                        @error('test_date')<span class="error-message">{{ $message }}</span>@enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="hbsag">HBsAg Status <span class="required">*</span></label>
                        <select id="hbsag" name="hbsag" required>
                            <option value="">Select Status</option>
                            <option value="positive" {{ old('hbsag', $patient->hbsag) == 'positive' ? 'selected' : '' }}>Positive</option>
                            <option value="negative" {{ old('hbsag', $patient->hbsag) == 'negative' ? 'selected' : '' }}>Negative</option>
                            <option value="pending" {{ old('hbsag', $patient->hbsag) == 'pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                        @error('hbsag')<span class="error-message">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="anti_hbs">Anti-HBs Status</label>
                        <select id="anti_hbs" name="anti_hbs">
                            <option value="">Select Status</option>
                            <option value="positive" {{ old('anti_hbs', $patient->anti_hbs) == 'positive' ? 'selected' : '' }}>Positive</option>
                            <option value="negative" {{ old('anti_hbs', $patient->anti_hbs) == 'negative' ? 'selected' : '' }}>Negative</option>
                            <option value="pending" {{ old('anti_hbs', $patient->anti_hbs) == 'pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="hbeag">HBeAg Status</label>
                        <select id="hbeag" name="hbeag">
                            <option value="">Select Status</option>
                            <option value="positive" {{ old('hbeag', $patient->hbeag) == 'positive' ? 'selected' : '' }}>Positive</option>
                            <option value="negative" {{ old('hbeag', $patient->hbeag) == 'negative' ? 'selected' : '' }}>Negative</option>
                            <option value="pending" {{ old('hbeag', $patient->hbeag) == 'pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="viral_load">Viral Load (IU/mL)</label>
                        <input type="number" id="viral_load" name="viral_load" value="{{ old('viral_load', $patient->viral_load) }}" placeholder="e.g., 2000">
                    </div>
                    
                    <div class="form-group">
                        <label for="alt_level">ALT Level (U/L)</label>
                        <input type="number" id="alt_level" name="alt_level" value="{{ old('alt_level', $patient->alt_level) }}" placeholder="e.g., 45">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="ast_level">AST Level (U/L)</label>
                        <input type="number" id="ast_level" name="ast_level" value="{{ old('ast_level', $patient->ast_level) }}" placeholder="e.g., 40">
                    </div>
                    
                    <div class="form-group">
                        <label for="platelet_count">Platelet Count (×10⁹/L)</label>
                        <input type="number" id="platelet_count" name="platelet_count" value="{{ old('platelet_count', $patient->platelet_count) }}" placeholder="e.g., 150">
                    </div>
                </div>

                <div class="form-group">
                    <label for="lab_notes">Laboratory Notes</label>
                    <textarea id="lab_notes" name="lab_notes" rows="3" placeholder="Additional laboratory information">{{ old('lab_notes', $patient->lab_notes) }}</textarea>
                </div>
            </div>

            <!-- Section 2: Treatment Information -->
            <div class="form-section">
                <h2 class="section-title">
                    <span class="section-number">2</span>
                    Treatment Information
                </h2>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="diagnosis_type">Diagnosis Type <span class="required">*</span></label>
                        <select id="diagnosis_type" name="diagnosis_type" required>
                            <option value="">Select Diagnosis</option>
                            <option value="acute" {{ old('diagnosis_type', $patient->diagnosis_type) == 'acute' ? 'selected' : '' }}>Acute Hepatitis B</option>
                            <option value="chronic" {{ old('diagnosis_type', $patient->diagnosis_type) == 'chronic' ? 'selected' : '' }}>Chronic Hepatitis B</option>
                            <option value="carrier" {{ old('diagnosis_type', $patient->diagnosis_type) == 'carrier' ? 'selected' : '' }}>Inactive Carrier</option>
                            <option value="resolved" {{ old('diagnosis_type', $patient->diagnosis_type) == 'resolved' ? 'selected' : '' }}>Resolved Infection</option>
                        </select>
                        @error('diagnosis_type')<span class="error-message">{{ $message }}</span>@enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="treatment_status">Treatment Status <span class="required">*</span></label>
                        <select id="treatment_status" name="treatment_status" required>
                            <option value="">Select Status</option>
                            <option value="on_treatment" {{ old('treatment_status', $patient->treatment_status) == 'on_treatment' ? 'selected' : '' }}>On Treatment</option>
                            <option value="not_started" {{ old('treatment_status', $patient->treatment_status) == 'not_started' ? 'selected' : '' }}>Treatment Not Started</option>
                            <option value="monitoring" {{ old('treatment_status', $patient->treatment_status) == 'monitoring' ? 'selected' : '' }}>Monitoring Only</option>
                            <option value="completed" {{ old('treatment_status', $patient->treatment_status) == 'completed' ? 'selected' : '' }}>Completed Treatment</option>
                        </select>
                        @error('treatment_status')<span class="error-message">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Vaccination Status <span class="required">*</span></label>
                    <div class="radio-group">
                        <label class="radio-label">
                            <input type="radio" name="vaccination_status" value="fully_vaccinated" {{ old('vaccination_status', $patient->vaccination_status) == 'fully_vaccinated' ? 'checked' : '' }} required>
                            <span>Fully Vaccinated (3 doses)</span>
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="vaccination_status" value="partially_vaccinated" {{ old('vaccination_status', $patient->vaccination_status) == 'partially_vaccinated' ? 'checked' : '' }}>
                            <span>Partially Vaccinated</span>
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="vaccination_status" value="not_vaccinated" {{ old('vaccination_status', $patient->vaccination_status) == 'not_vaccinated' ? 'checked' : '' }}>
                            <span>Not Vaccinated</span>
                        </label>
                    </div>
                    @error('vaccination_status')<span class="error-message">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="prescribed_medication">Prescribed Medication</label>
                    <textarea id="prescribed_medication" name="prescribed_medication" rows="3" placeholder="List medications and dosage (e.g., Tenofovir 300mg daily)">{{ old('prescribed_medication', $patient->prescribed_medication) }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="next_appointment">Next Appointment Date</label>
                        <input type="date" id="next_appointment" name="next_appointment" value="{{ old('next_appointment', $patient->next_appointment) }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="doctor_name">Attending Physician</label>
                        <input type="text" id="doctor_name" name="doctor_name" value="{{ old('doctor_name', $patient->doctor_name) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="treatment_notes">Treatment Notes</label>
                    <textarea id="treatment_notes" name="treatment_notes" rows="4" placeholder="Additional notes about treatment plan or patient condition">{{ old('treatment_notes', $patient->treatment_notes) }}</textarea>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('hbv.show', $patient->id) }}" class="btn btn-secondary">Cancel</a>
                
                <button type="submit" class="btn btn-primary">Update Patient Information</button>
            </div>
        </form>
    </div>
        @vite('resources/js/patients/edit.js')
    {{-- <script src="{{ asset('js/patient-edit.js') }}"></script> --}}
</body>
</html>