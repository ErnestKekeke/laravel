<!DOCTYPE html>
<html lang="en">
<head>

    @include('layouts.meta')
    @vite('resources/css/reset.css')
    @vite('resources/css/patients/index.css')
    <title>Patients List - HBV Management</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/clinic-profile.css') }}"> --}}
</head>


{{-- <h3>all patient </h3>

@foreach($patients as $patient)
    <div>{{ $patient->first_name }}</div>
@endforeach --}}


<body>

@auth('clinic')      
    <div class="container">
        <!-- Header -->
        <div class="page-header">
            <div class="header-content">
                <h1>Patients Management</h1>
                <p class="subtitle">{{ Auth::guard('clinic')->user()->clinic_name ?? 'Medical Clinic' }}</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('clinic.patient') }}" class="btn btn-primary">
                    <span class="icon">+</span>
                    Add New Patient
                </a>


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

        <!-- Patients Count -->
        <div class="stats-bar">
            <div class="stat-item">
                <span class="stat-label">Total Patients:</span>
                <span class="stat-value">{{ $patients->total() }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Showing:</span>
                <span class="stat-value">{{ $patients->firstItem() ?? 0 }} - {{ $patients->lastItem() ?? 0 }}</span>
            </div>
        </div>

        <!-- Patients Table -->
        @if($patients->count() > 0)
        <div class="table-container">
            <table class="patients-table">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Patient Name</th>
                        <th>Gender</th>
                        <th>Test Date</th>
                        <th>Diagnosis</th>
                        <th>Treatment Status</th>
                        <th>Vaccination</th>
                        <th>Next Appointment</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patients as $patient)
                    <tr>
                        <td class="photo-cell">
                            @if($patient->photo_path)
                                <img src="{{ asset('storage/' . $patient->photo_path) }}" 
                                     alt="{{ $patient->first_name }}" 
                                     class="patient-photo"
                                     onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                            @else
                                <img src="{{ asset('images/default-avatar.png') }}" 
                                     alt="Default Avatar" 
                                     class="patient-photo">
                            @endif
                        </td>
                        <td class="name-cell">
                            <div class="patient-name">{{ $patient->first_name }} {{ $patient->last_name }}</div>
                            <div class="patient-id">{{ $patient->patient_id }}</div>
                        </td>
                        <td>
                            <span class="badge badge-gender-{{ $patient->gender }}">
                                {{ ucfirst($patient->gender) }}
                            </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($patient->test_date)->format('M d, Y') }}</td>
                        <td>
                            <span class="badge badge-diagnosis-{{ $patient->diagnosis_type }}">
                                {{ ucfirst(str_replace('_', ' ', $patient->diagnosis_type)) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-treatment-{{ $patient->treatment_status }}">
                                {{ ucfirst(str_replace('_', ' ', $patient->treatment_status)) }}
                            </span>
                        </td>
                        <td>
                            @if($patient->vaccination_status == 'fully_vaccinated')
                                <span class="badge badge-success">Fully Vaccinated</span>
                            @elseif($patient->vaccination_status == 'partially_vaccinated')
                                <span class="badge badge-warning">Partially Vaccinated</span>
                            @else
                                <span class="badge badge-danger">Not Vaccinated</span>
                            @endif
                        </td>
                        <td>
                            @if($patient->next_appointment)
                                {{ \Carbon\Carbon::parse($patient->next_appointment)->format('M d, Y') }}
                            @else
                                <span class="text-muted">Not scheduled</span>
                            @endif
                        </td>
                        <td class="actions-cell">
                            <div class="action-buttons">
                                <a href="{{ route('hbv.show', $patient->id) }}" class="btn-action btn-view" title="View Details">
                                {{-- <a href="" class="btn-action btn-view" title="View Details"> --}}
                                    <span class="action-icon">👁️</span>
                                    <span class="action-text">View</span>
                                </a>

                                <a href="{{ route('hbv.edit', $patient->id) }}" class="btn-action btn-edit" title="Update Information">
                                {{-- <a href="" class="btn-action btn-edit" title="Update Information">     --}}
                                    <span class="action-icon">✏️</span>
                                    <span class="action-text">Edit</span>
                                </a>
                                <form action="{{ route('hbv.destroy', $patient->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this patient record?');">
                                    {{-- <form action="" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this patient record?');"> --}}
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Delete Record">
                                        <span class="action-icon">🗑️</span>
                                        <span class="action-text">Delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-container">
            {{ $patients->links() }}
        </div>
 <a href="{{ route('clinic') }}" class="btn btn-clinic">Clinic Details</a>
        @else
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-icon">📋</div>
            <h3>No Patients Found</h3>
            <p>Start by adding your first patient to the system.</p>
            {{-- <a href="{{ route('patient.register') }}" class="btn btn-primary">Add New Patient</a> --}}
        </div>
        @endif
    </div>
  
@else
    <p> You are not login </p>
    <a href="{{ route('clinic.login') }}">Clinic Login</a> <br/>
     <a href="{{route('home') }}">goto home</a>
@endauth  


</body>
</html>

