<!DOCTYPE html>
<html lang="en">
<head>
    {{-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Patient Details - {{ $patient->first_name }} {{ $patient->last_name }}</title>
    <link rel="stylesheet" href="{{ asset('css/patient-show.css') }}"> --}}

    @include('layouts.meta')
    @vite('resources/css/reset.css')
    @vite('resources/css/patients/show.css')
    <title>Patient Details - {{ $patient->first_name }} {{ $patient->last_name }}</title>
 
</head>
<body>

@auth('clinic')

    <div class="container">
        <!-- Header -->
        <div class="page-header">
            <a href="{{ route('hbv') }}" class="btn-back">
                ← Back to Patients
            </a>
            <div class="header-actions">
                <a href="{{ route('hbv.edit', $patient->id) }}" class="btn btn-primary">
                {{-- <a href="" class="btn btn-primary"> --}}
                    ✏️ Edit Patient
                </a>
                <form action="{{ route('hbv.destroy', $patient->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this patient?');">
                {{-- <form action="" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this patient?');"> --}}
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        🗑️ Delete Patient
                    </button>
                </form>
            </div>
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

        <!-- Patient Profile Card -->
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-photo">
                    @if($patient->photo_path)
                        <img src="{{ asset('storage/' . $patient->photo_path) }}" 
                             alt="{{ $patient->first_name }}" 
                             onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                    @else
                        <img src="{{ asset('images/default-avatar.png') }}" alt="Default Avatar">
                    @endif
                </div>
                <div class="profile-info">
                    <h1 class="patient-name">{{ $patient->first_name }} {{ $patient->middle_name }} {{ $patient->last_name }}</h1>
                    <div class="patient-meta">
                        <span class="meta-item">
                            <strong>Patient ID:</strong> {{ $patient->patient_id }}
                        </span>
                        <span class="meta-item">
                            <strong>Age:</strong> {{ \Carbon\Carbon::parse($patient->date_of_birth)->age }} years
                        </span>
                        <span class="meta-item">
                            <strong>Gender:</strong> 
                            <span class="badge badge-gender-{{ $patient->gender }}">
                                {{ ucfirst($patient->gender) }}
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Details Grid -->
        <div class="details-grid">
            <!-- Personal Information -->
            <div class="detail-card">
                <h2 class="card-title">Personal Information</h2>
                <div class="detail-content">
                    <div class="detail-row">
                        <span class="detail-label">Full Name</span>
                        <span class="detail-value">{{ $patient->first_name }} {{ $patient->middle_name }} {{ $patient->last_name }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Date of Birth</span>
                        <span class="detail-value">{{ \Carbon\Carbon::parse($patient->date_of_birth)->format('F d, Y') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Age</span>
                        <span class="detail-value">{{ \Carbon\Carbon::parse($patient->date_of_birth)->age }} years</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Gender</span>
                        <span class="detail-value">
                            <span class="badge badge-gender-{{ $patient->gender }}">
                                {{ ucfirst($patient->gender) }}
                            </span>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="detail-card">
                <h2 class="card-title">Contact Information</h2>
                <div class="detail-content">
                    <div class="detail-row">
                        <span class="detail-label">Phone Number</span>
                        <span class="detail-value">{{ $patient->phone }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Email Address</span>
                        <span class="detail-value">{{ $patient->email ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Address</span>
                        <span class="detail-value">{{ $patient->address }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">City</span>
                        <span class="detail-value">{{ ucfirst(str_replace('_', ' ', $patient->city)) }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">State</span>
                        <span class="detail-value">{{ $patient->state }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Country</span>
                        <span class="detail-value">{{ $patient->country }}</span>
                    </div>
                </div>
            </div>

            <!-- Laboratory Results -->
            <div class="detail-card">
                <h2 class="card-title">Laboratory Results</h2>
                <div class="detail-content">
                    <div class="detail-row">
                        <span class="detail-label">Test Date</span>
                        <span class="detail-value">{{ \Carbon\Carbon::parse($patient->test_date)->format('F d, Y') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">HBsAg Status</span>
                        <span class="detail-value">
                            <span class="badge badge-lab-{{ $patient->hbsag }}">
                                {{ ucfirst($patient->hbsag) }}
                            </span>
                        </span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Anti-HBs Status</span>
                        <span class="detail-value">
                            @if($patient->anti_hbs)
                                <span class="badge badge-lab-{{ $patient->anti_hbs }}">
                                    {{ ucfirst($patient->anti_hbs) }}
                                </span>
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">HBeAg Status</span>
                        <span class="detail-value">
                            @if($patient->hbeag)
                                <span class="badge badge-lab-{{ $patient->hbeag }}">
                                    {{ ucfirst($patient->hbeag) }}
                                </span>
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Viral Load</span>
                        <span class="detail-value">{{ $patient->viral_load ? number_format($patient->viral_load) . ' IU/mL' : 'N/A' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">ALT Level</span>
                        <span class="detail-value">{{ $patient->alt_level ? $patient->alt_level . ' U/L' : 'N/A' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">AST Level</span>
                        <span class="detail-value">{{ $patient->ast_level ? $patient->ast_level . ' U/L' : 'N/A' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Platelet Count</span>
                        <span class="detail-value">{{ $patient->platelet_count ? number_format($patient->platelet_count) . ' ×10⁹/L' : 'N/A' }}</span>
                    </div>
                    @if($patient->lab_notes)
                    <div class="detail-row full-width">
                        <span class="detail-label">Laboratory Notes</span>
                        <span class="detail-value">{{ $patient->lab_notes }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Treatment Plan -->
            <div class="detail-card">
                <h2 class="card-title">Treatment Plan</h2>
                <div class="detail-content">
                    <div class="detail-row">
                        <span class="detail-label">Diagnosis Type</span>
                        <span class="detail-value">
                            <span class="badge badge-diagnosis-{{ $patient->diagnosis_type }}">
                                {{ ucfirst(str_replace('_', ' ', $patient->diagnosis_type)) }}
                            </span>
                        </span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Treatment Status</span>
                        <span class="detail-value">
                            <span class="badge badge-treatment-{{ $patient->treatment_status }}">
                                {{ ucfirst(str_replace('_', ' ', $patient->treatment_status)) }}
                            </span>
                        </span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Vaccination Status</span>
                        <span class="detail-value">
                            @if($patient->vaccination_status == 'fully_vaccinated')
                                <span class="badge badge-success">Fully Vaccinated</span>
                            @elseif($patient->vaccination_status == 'partially_vaccinated')
                                <span class="badge badge-warning">Partially Vaccinated</span>
                            @else
                                <span class="badge badge-danger">Not Vaccinated</span>
                            @endif
                        </span>
                    </div>
                    @if($patient->prescribed_medication)
                    <div class="detail-row full-width">
                        <span class="detail-label">Prescribed Medication</span>
                        <span class="detail-value">{{ $patient->prescribed_medication }}</span>
                    </div>
                    @endif
                    <div class="detail-row">
                        <span class="detail-label">Next Appointment</span>
                        <span class="detail-value">
                            @if($patient->next_appointment)
                                <strong>{{ \Carbon\Carbon::parse($patient->next_appointment)->format('F d, Y') }}</strong>
                            @else
                                <span class="text-muted">Not scheduled</span>
                            @endif
                        </span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Attending Physician</span>
                        <span class="detail-value">{{ $patient->doctor_name ?? 'N/A' }}</span>
                    </div>
                    @if($patient->treatment_notes)
                    <div class="detail-row full-width">
                        <span class="detail-label">Treatment Notes</span>
                        <span class="detail-value">{{ $patient->treatment_notes }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Record Information -->
        <div class="record-info">
            <p><strong>Created:</strong> {{ $patient->created_at->format('F d, Y h:i A') }}</p>
            <p><strong>Last Updated:</strong> {{ $patient->updated_at->format('F d, Y h:i A') }}</p>
        </div>
    </div>

@else
    <p> You are not login </p>
    <a href="{{ route('clinic.login') }}">Clinic Login</a> <br/>
     <a href="{{route('home') }}">goto home</a>
     
@endauth      
</body>
</html>