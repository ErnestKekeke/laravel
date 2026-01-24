<!-- resources/views/hospital_register.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.meta')
    @vite('resources/css/reset.css')
    @vite('resources/css/hospital_register.css')
    <title>Hospital Registration - Hospital Location System</title>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <span class="nav-icon">🏥</span>
                <span class="nav-title">Hospital Location System</span>
            </div>
            <div class="nav-links">
                <a href="{{ route('home') }}" class="nav-link">
                    <span class="link-icon">🏠</span>
                    Home
                </a>
                <a href="{{ route('hospital_register') }}" class="nav-link active">
                    <span class="link-icon">📝</span>
                    Register Hospital
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="main-container">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                <span class="alert-icon">✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @elseif(session('info'))
            <div class="alert alert-info">
                <span class="alert-icon">ℹ</span>
                <span>{{ session('info') }}</span>
            </div>
        @elseif(session('error'))
            <div class="alert alert-error">
                <span class="alert-icon">✕</span>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Hospital Registration</h1>
            <p class="page-subtitle">Register your hospital in our Map Location System</p>
        </div>

        <!-- Registration Form Card -->
        <div class="form-card">
            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="error-box">
                    <h3 class="error-title">Please correct the following errors:</h3>
                    <ul class="error-list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="hospitalRegisterForm" action="{{ route('hospital_register.register') }}" 
                method="POST" enctype="multipart/form-data" class="registration-form">
                @csrf

                <!-- Hospital Logo Section -->
                <div class="form-section">
                    <h2 class="section-title">
                        <span class="section-icon">🖼️</span>
                        Hospital Logo
                    </h2>
                    
                    <div class="logo-upload-container">
                        <div class="logo-preview-wrapper">
                            <img id="preview" class="logo-preview" style="display:none;" alt="Logo Preview">
                            <div id="logo-placeholder" class="logo-placeholder">
                                <span class="placeholder-icon">🏥</span>
                                <span class="placeholder-text">No logo uploaded</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="logo" class="form-label">
                                Upload Hospital Logo <span class="required">*</span>
                            </label>
                            <input type="file" id="logo" name="logo" class="file-input" accept=".png" required/>
                            <small class="form-hint">Preferred size: 200x200px, PNG format.</small>
                            @error('logo')<span class="error-message">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <script>
                        // Logo preview functionality
                        document.getElementById('logo').addEventListener('change', function(e) {
                            const file = e.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const preview = document.getElementById('preview');
                                    const placeholder = document.getElementById('logo-placeholder');
                                    
                                    preview.src = e.target.result;
                                    preview.style.display = 'block';
                                    placeholder.style.display = 'none';
                                };
                                reader.readAsDataURL(file);
                            }
                        });
                    </script>
                </div>

                <!-- Basic Information Section -->
                <div class="form-section">
                    <h2 class="section-title">
                        <span class="section-icon">ℹ️</span>
                        Basic Information
                    </h2>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="hospital_name" class="form-label">
                                Hospital Name <span class="required">*</span>
                            </label>
                            <input type="text" id="hospital_name" name="hospital_name" 
                                class="form-input" value="{{ old('hospital_name') }}" 
                                required placeholder="Enter hospital name">
                            @error('hospital_name')<span class="error-message">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="hospital_type" class="form-label">
                                Hospital Type <span class="required">*</span>
                            </label>
                            <select id="hospital_type" name="hospital_type" class="form-select" required>
                                <option value="">Select hospital type</option>
                                <option value="general" {{ old('hospital_type') == 'general' ? 'selected' : '' }}>General</option>
                                <option value="specialty" {{ old('hospital_type') == 'specialty' ? 'selected' : '' }}>Specialty</option>
                                <option value="teaching" {{ old('hospital_type') == 'teaching' ? 'selected' : '' }}>Teaching</option>
                                <option value="tertiary" {{ old('hospital_type') == 'tertiary' ? 'selected' : '' }}>Tertiary</option>
                                <option value="community" {{ old('hospital_type') == 'community' ? 'selected' : '' }}>Community</option>
                                <option value="pediatric" {{ old('hospital_type') == 'pediatric' ? 'selected' : '' }}>Pediatric</option>
                                <option value="maternity" {{ old('hospital_type') == 'maternity' ? 'selected' : '' }}>Maternity</option>
                                <option value="psychiatric" {{ old('hospital_type') == 'psychiatric' ? 'selected' : '' }}>Psychiatric</option>
                                <option value="rehabilitation" {{ old('hospital_type') == 'rehabilitation' ? 'selected' : '' }}>Rehabilitation</option>
                                <option value="surgical" {{ old('hospital_type') == 'surgical' ? 'selected' : '' }}>Surgical</option>
                                <option value="diagnostic" {{ old('hospital_type') == 'diagnostic' ? 'selected' : '' }}>Diagnostic</option>
                                <option value="dental" {{ old('hospital_type') == 'dental' ? 'selected' : '' }}>Dental</option>
                            </select>
                            @error('hospital_type')<span class="error-message">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="reg_no" class="form-label">
                                Hospital Registration Number <span class="required">*</span>
                            </label>
                            <input type="text" id="reg_no" name="reg_no" class="form-input" 
                                value="{{ old('reg_no') }}" required placeholder="Enter registration number">
                            @error('reg_no')<span class="error-message">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="lic_issue_dt" class="form-label">
                                License Issue Date <span class="required">*</span>
                            </label>
                            <input type="date" id="lic_issue_dt" name="lic_issue_dt" 
                                class="form-input" value="{{ old('lic_issue_dt') }}" required>
                            @error('lic_issue_dt')<span class="error-message">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="accred_status" class="form-label">
                                Accreditation Status <span class="required">*</span>
                            </label>
                            <select id="accred_status" name="accred_status" class="form-select" required>
                                <option value="none" {{ old('accred_status', 'none') == 'none' ? 'selected' : '' }}>None</option>
                                <option value="pending" {{ old('accred_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="accredited" {{ old('accred_status') == 'accredited' ? 'selected' : '' }}>Accredited</option>
                            </select>
                            @error('accred_status')<span class="error-message">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="med_dir" class="form-label">
                                Medical Director <span class="required">*</span>
                            </label>
                            <input type="text" id="med_dir" name="med_dir" class="form-input" 
                                value="{{ old('med_dir') }}" required placeholder="Enter medical director name">
                            @error('med_dir')<span class="error-message">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="beds" class="form-label">
                                Number of Beds <span class="required">*</span>
                            </label>
                            <input type="number" id="beds" name="beds" class="form-input" 
                                value="{{ old('beds') }}" min="0" required placeholder="Enter bed capacity">
                            @error('beds')<span class="error-message">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="ownership" class="form-label">
                                Ownership <span class="required">*</span>
                            </label>
                            <select id="ownership" name="ownership" class="form-select" required>
                                <option value="">Select ownership</option>
                                <option value="government" {{ old('ownership') == 'government' ? 'selected' : '' }}>Government</option>
                                <option value="private" {{ old('ownership') == 'private' ? 'selected' : '' }}>Private</option>
                                <option value="charitable" {{ old('ownership') == 'charitable' ? 'selected' : '' }}>Charitable / NGO</option>
                            </select>
                            @error('ownership')<span class="error-message">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <!-- Contact & Location Section -->
                <div class="form-section">
                    <h2 class="section-title">
                        <span class="section-icon">📞</span>
                        Contact & Location
                    </h2>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="email" class="form-label">
                                Email Address <span class="required">*</span>
                            </label>
                            <input type="email" id="email" name="email" class="form-input" 
                                value="{{ old('email') }}" required placeholder="hospital@example.com">
                            @error('email')<span class="error-message">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="contact_no" class="form-label">
                                Contact Number <span class="required">*</span>
                            </label>
                            <input type="text" id="contact_no" name="contact_no" class="form-input" 
                                value="{{ old('contact_no') }}" required placeholder="+1234567890">
                            @error('contact_no')<span class="error-message">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group full-width">
                            <label for="address" class="form-label">
                                Address <span class="required">*</span>
                            </label>
                            <textarea id="address" name="address" class="form-textarea" 
                                required placeholder="Enter complete address">{{ old('address') }}</textarea>
                            @error('address')<span class="error-message">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="country_select" class="form-label">
                                Country <span class="required">*</span>
                            </label>
                            <select id="country_select" name="country_select" class="form-select" required>
                                <option value="">Select Country</option>
                            </select>
                            <input type="hidden" name="country" id="country_text">
                            @error('country')<span class="error-message">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="state_select" class="form-label">
                                State/Province <span class="required">*</span>
                            </label>
                            <select id="state_select" name="state_select" class="form-select" required disabled>
                                <option value="">Select State</option>
                            </select>
                            <input type="hidden" name="state" id="state_text">
                            @error('state')<span class="error-message">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="city" class="form-label">
                                City <span class="required">*</span>
                            </label>
                            <select id="city" name="city" class="form-select" required disabled>
                                <option value="">Select City</option>
                            </select>
                            @error('city')<span class="error-message">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="zip_code" class="form-label">
                                Zip/Postal Code <span class="required">*</span>
                            </label>
                            <input type="text" id="zip_code" name="zip_code" class="form-input" 
                                value="{{ old('zip_code') }}" required placeholder="Enter zip/postal code">
                            @error('zip_code')<span class="error-message">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <!-- Hospital Location Section -->
                <div class="form-section">
                    <h2 class="section-title">
                        <span class="section-icon">📍</span>
                        Hospital Location Coordinates
                    </h2>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="latitude" class="form-label">
                                Latitude <span class="required">*</span>
                            </label>
                            <input type="text" id="latitude" name="latitude" class="form-input" 
                                value="{{ old('latitude') }}" required placeholder="e.g., 37.421998">
                            @error('latitude')<span class="error-message">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="longitude" class="form-label">
                                Longitude <span class="required">*</span>
                            </label>
                            <input type="text" id="longitude" name="longitude" class="form-input" 
                                value="{{ old('longitude') }}" required placeholder="e.g., -122.084000">
                            @error('longitude')<span class="error-message">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-actions">
                    <button type="submit" class="submit-btn">
                        <span class="btn-icon">✓</span>
                        Register Hospital
                    </button>
                    <a href="{{ route('home') }}" class="cancel-btn">
                        <span class="btn-icon">←</span>
                        Back to Home
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; {{ date('Y') }} Hospital Location System. All rights reserved.</p>
        </div>
    </footer>

    @vite('resources/js/hospital_register.js')
</body>
</html>