<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.meta')
    @vite('resources/css/reset.css')
    @vite('resources/css/clinic/patient.css')
    <title>Patient Registration - HBV Management</title>
</head>
<body>
    @php
        $clinic = Auth::guard('clinic')->user();
    @endphp   
    <div class="form-container">
        <div class="form-header">
            <div class="logo">

                @if($clinic->clinic_id)
                            <img style="max-width:70px;" src="{{ asset('storage/' . 'logos/' . $clinic->clinic_id . '.png') }}" alt="Logo">
                        @else
                            <img style="max-width:70px;" src="https://cdn-icons-png.flaticon.com/512/2913/2913133.png" alt="Logo">
                        @endif

                <h1>Hepatitis B Patient Registration</h1>
            </div>
            <p class="clinic-name">{{ Auth::user()->clinic_name ?? 'Medical Clinic' }}</p>
        </div>

        <form action="{{ route('clinic.patient')  }}" method="POST" enctype="multipart/form-data" class="patient-form" id="patientForm">
            @csrf

            <!-- Section 1: Personal Information -->
            <div class="form-section">
                <h2 class="section-title">
                    <span class="section-number">1</span>
                    Personal Information
                </h2>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">First Name <span class="required">*</span></label>
                        <input type="text" id="first_name" name="first_name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="last_name">Last Name <span class="required">*</span></label>
                        <input type="text" id="last_name" name="last_name" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" id="middle_name" name="middle_name">
                    </div>
                    
                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth <span class="required">*</span></label>
                        <input type="date" id="date_of_birth" name="date_of_birth" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="gender">Gender <span class="required">*</span></label>
                        <select id="gender" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="patient_id">Patient ID/Hospital Number</label>
                        <input type="text" id="patient_id" name="patient_id" placeholder="Auto-generated if left blank">
                    </div>
                </div>

                <div class="form-group">
                    <label for="patient_image">Patient Photo</label>
                    <div class="image-upload-container">
                        <div class="image-preview">
                            <img id="imagePreview" src="https://via.placeholder.com/150/e2e8f0/4a5568?text=No+Image" alt="Patient Photo">
                        </div>
                        <div class="upload-controls">
                            <input type="file" id="patient_image" name="patient_image" accept="image/*" style="display: none;">
                            <button type="button" class="btn-upload" onclick="document.getElementById('patient_image').click()">
                                Choose Photo
                            </button>
                            <button type="button" class="btn-remove" id="removeImage" style="display: none;">
                                Remove Photo
                            </button>
                            <p class="upload-hint">Accepted: JPG, PNG (Max 2MB)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Contact Information -->
            <div class="form-section">
                <h2 class="section-title">
                    <span class="section-number">2</span>
                    Contact Information
                </h2>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="phone">Phone Number <span class="required">*</span></label>
                        <input type="tel" id="phone" name="phone" required placeholder="+234 xxx xxx xxxx">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="patient@example.com">
                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Residential Address <span class="required">*</span></label>
                    <input type="text" id="address" name="address" required placeholder="Street address">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="country_select">Country <span class="required">*</span></label>
                        <select id="country_select" name="country_select" value="{{ old('country') }}" required>
                            <option value="">Select Country</option>
                        </select>
                        <input type="hidden" name="country" id="country_text">
                        @error('country')<span class="error-message">{{ $message }}</span>@enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="state_select">State/Province <span class="required">*</span></label>
                        <select id="state_select" name="state_select" required disabled>
                            <option value="">Select State</option>
                        </select>
                        <input type="hidden" name="state" id="state_text">
                        @error('state')<span class="error-message">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="city">City <span class="required">*</span></label>
                        <select id="city" name="city" required disabled>
                            <option value="">Select City</option>
                        </select>
                        @error('city')<span class="error-message">{{ $message }}</span>@enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code') }}">
                    </div>
                </div>
            </div>

            <!-- Section 3: Initial Laboratory Results -->
            <div class="form-section">
                <h2 class="section-title">
                    <span class="section-number">3</span>
                    Initial Laboratory Results
                </h2>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="test_date">Date of Test <span class="required">*</span></label>
                        <input type="date" id="test_date" name="test_date" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="hbsag">HBsAg Status <span class="required">*</span></label>
                        <select id="hbsag" name="hbsag" required>
                            <option value="">Select Status</option>
                            <option value="positive">Positive</option>
                            <option value="negative">Negative</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="anti_hbs">Anti-HBs Status</label>
                        <select id="anti_hbs" name="anti_hbs">
                            <option value="">Select Status</option>
                            <option value="positive">Positive</option>
                            <option value="negative">Negative</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="hbeag">HBeAg Status</label>
                        <select id="hbeag" name="hbeag">
                            <option value="">Select Status</option>
                            <option value="positive">Positive</option>
                            <option value="negative">Negative</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="viral_load">Viral Load (IU/mL)</label>
                        <input type="number" id="viral_load" name="viral_load" placeholder="e.g., 2000">
                    </div>
                    
                    <div class="form-group">
                        <label for="alt_level">ALT Level (U/L)</label>
                        <input type="number" id="alt_level" name="alt_level" placeholder="e.g., 45">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="ast_level">AST Level (U/L)</label>
                        <input type="number" id="ast_level" name="ast_level" placeholder="e.g., 40">
                    </div>
                    
                    <div class="form-group">
                        <label for="platelet_count">Platelet Count (×10⁹/L)</label>
                        <input type="number" id="platelet_count" name="platelet_count" placeholder="e.g., 150">
                    </div>
                </div>

                <div class="form-group">
                    <label for="lab_notes">Laboratory Notes</label>
                    <textarea id="lab_notes" name="lab_notes" rows="2" placeholder="Additional laboratory information"></textarea>
                </div>
            </div>

            <!-- Section 4: Treatment Plan -->
            <div class="form-section">
                <h2 class="section-title">
                    <span class="section-number">4</span>
                    Treatment Plan
                </h2>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="diagnosis_type">Diagnosis Type <span class="required">*</span></label>
                        <select id="diagnosis_type" name="diagnosis_type" required>
                            <option value="">Select Diagnosis</option>
                            <option value="acute">Acute Hepatitis B</option>
                            <option value="chronic">Chronic Hepatitis B</option>
                            <option value="carrier">Inactive Carrier</option>
                            <option value="resolved">Resolved Infection</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="treatment_status">Treatment Status <span class="required">*</span></label>
                        <select id="treatment_status" name="treatment_status" required>
                            <option value="">Select Status</option>
                            <option value="on_treatment">On Treatment</option>
                            <option value="not_started">Treatment Not Started</option>
                            <option value="monitoring">Monitoring Only</option>
                            <option value="completed">Completed Treatment</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="vaccination_status">Vaccination Status <span class="required">*</span></label>
                    <div class="radio-group">
                        <label class="radio-label">
                            <input type="radio" name="vaccination_status" value="fully_vaccinated" required>
                            <span>Fully Vaccinated (3 doses)</span>
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="vaccination_status" value="partially_vaccinated">
                            <span>Partially Vaccinated</span>
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="vaccination_status" value="not_vaccinated">
                            <span>Not Vaccinated</span>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="prescribed_medication">Prescribed Medication</label>
                    <textarea id="prescribed_medication" name="prescribed_medication" rows="2" placeholder="List medications and dosage (e.g., Tenofovir 300mg daily)"></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="next_appointment">Next Appointment Date</label>
                        <input type="date" id="next_appointment" name="next_appointment">
                    </div>
                    
                    <div class="form-group">
                        <label for="doctor_name">Attending Physician</label>
                        <input type="text" id="doctor_name" name="doctor_name" value="{{ Auth::user()->name ?? '' }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="treatment_notes">Treatment Notes</label>
                    <textarea id="treatment_notes" name="treatment_notes" rows="3" placeholder="Additional notes about treatment plan or patient condition"></textarea>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
                <button type="submit" class="btn btn-primary">Register Patient</button>
            </div>
        </form>
    </div>

    <script>
        // Country, State, City data will be loaded from external API
        let countriesData = [];

        // Load countries on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadCountries();
        });

        // Load countries from API
        async function loadCountries() {
            try {
                const response = await fetch('https://restcountries.com/v3.1/all');
                const countries = await response.json();
                
                // Sort countries alphabetically
                countriesData = countries.sort((a, b) => 
                    a.name.common.localeCompare(b.name.common)
                );

                const countrySelect = document.getElementById('country_select');
                countriesData.forEach(country => {
                    const option = document.createElement('option');
                    option.value = country.cca2; // Country code
                    option.textContent = country.name.common;
                    option.dataset.name = country.name.common;
                    countrySelect.appendChild(option);
                });
            } catch (error) {
                console.error('Error loading countries:', error);
            }
        }

        // Country change handler
        document.getElementById('country_select').addEventListener('change', async function() {
            const countryCode = this.value;
            const countryName = this.options[this.selectedIndex].dataset.name;
            const stateSelect = document.getElementById('state_select');
            const citySelect = document.getElementById('city');
            
            // Update hidden input with country name
            document.getElementById('country_text').value = countryName;
            
            // Reset and disable city
            citySelect.innerHTML = '<option value="">Select City</option>';
            citySelect.disabled = true;
            document.getElementById('state_text').value = '';
            
            // Reset state
            stateSelect.innerHTML = '<option value="">Select State</option>';
            
            if (countryCode) {
                try {
                    // Load states/regions for selected country
                    const response = await fetch(`https://restcountries.com/v3.1/alpha/${countryCode}`);
                    const countryData = await response.json();
                    
                    // For demonstration, we'll use a predefined list for common countries
                    // In production, you'd use a proper state/city API
                    const statesData = getStatesForCountry(countryCode, countryName);
                    
                    if (statesData && Object.keys(statesData).length > 0) {
                        Object.keys(statesData).forEach(state => {
                            const option = document.createElement('option');
                            option.value = state;
                            option.textContent = state.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                            option.dataset.cities = JSON.stringify(statesData[state]);
                            stateSelect.appendChild(option);
                        });
                        stateSelect.disabled = false;
                    } else {
                        // If no states data, allow manual entry
                        stateSelect.disabled = false;
                    }
                } catch (error) {
                    console.error('Error loading states:', error);
                    stateSelect.disabled = false;
                }
            } else {
                stateSelect.disabled = true;
            }
        });

        // State change handler
        document.getElementById('state_select').addEventListener('change', function() {
            const state = this.value;
            const stateName = this.options[this.selectedIndex].textContent;
            const citySelect = document.getElementById('city');
            
            // Update hidden input with state name
            document.getElementById('state_text').value = stateName;
            
            citySelect.innerHTML = '<option value="">Select City</option>';
            
            if (state) {
                const citiesData = JSON.parse(this.options[this.selectedIndex].dataset.cities || '[]');
                
                if (citiesData.length > 0) {
                    citiesData.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.toLowerCase().replace(/\s+/g, '_');
                        option.textContent = city;
                        citySelect.appendChild(option);
                    });
                }
                citySelect.disabled = false;
            } else {
                citySelect.disabled = true;
            }
        });

        // Predefined states and cities for common countries
        function getStatesForCountry(countryCode, countryName) {
            const statesData = {
                'NG': { // Nigeria
                    'lagos': ['Ikeja', 'Lagos Island', 'Surulere', 'Yaba', 'Ikorodu', 'Epe', 'Badagry'],
                    'abuja': ['Central Area', 'Garki', 'Wuse', 'Asokoro', 'Maitama', 'Kubwa', 'Gwagwalada'],
                    'kano': ['Kano Municipal', 'Nassarawa', 'Fagge', 'Dala', 'Gwale', 'Tarauni'],
                    'rivers': ['Port Harcourt', 'Obio-Akpor', 'Eleme', 'Okrika', 'Oyigbo', 'Bonny'],
                    'oyo': ['Ibadan North', 'Ibadan South-West', 'Ibadan North-East', 'Ogbomosho'],
                    'kaduna': ['Kaduna North', 'Kaduna South', 'Zaria', 'Kafanchan', 'Kagoro'],
                    'edo': ['Benin City', 'Auchi', 'Ekpoma', 'Uromi', 'Igarra'],
                    'delta': ['Warri', 'Asaba', 'Sapele', 'Ughelli', 'Agbor'],
                    'ogun': ['Abeokuta', 'Ijebu Ode', 'Sagamu', 'Ilaro', 'Ota'],
                    'anambra': ['Awka', 'Onitsha', 'Nnewi', 'Ekwulobia', 'Ihiala']
                },
                'GH': { // Ghana
                    'greater_accra': ['Accra', 'Tema', 'Madina', 'Kasoa', 'Teshie'],
                    'ashanti': ['Kumasi', 'Obuasi', 'Mampong', 'Konongo'],
                    'western': ['Sekondi-Takoradi', 'Tarkwa', 'Axim'],
                    'eastern': ['Koforidua', 'Akosombo', 'Mpraeso']
                },
                'KE': { // Kenya
                    'nairobi': ['Nairobi', 'Westlands', 'Eastleigh', 'Kibera'],
                    'mombasa': ['Mombasa', 'Nyali', 'Likoni'],
                    'nakuru': ['Nakuru', 'Naivasha']
                },
                'ZA': { // South Africa
                    'gauteng': ['Johannesburg', 'Pretoria', 'Soweto', 'Sandton'],
                    'western_cape': ['Cape Town', 'Stellenbosch', 'Paarl'],
                    'kwazulu_natal': ['Durban', 'Pietermaritzburg', 'Richards Bay']
                }
            };

            return statesData[countryCode] || {};
        }

        // Image upload preview
        document.getElementById('patient_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const imagePreview = document.getElementById('imagePreview');
            const removeBtn = document.getElementById('removeImage');
            
            if (file) {
                // Validate file size (2MB max)
                if (file.size > 2 * 1024 * 1024) {
                    alert('File size must be less than 2MB');
                    this.value = '';
                    return;
                }
                
                // Validate file type
                if (!file.type.match('image.*')) {
                    alert('Please select an image file');
                    this.value = '';
                    return;
                }
                
                // Display image preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    removeBtn.style.display = 'inline-block';
                };
                reader.readAsDataURL(file);
            }
        });

        // Remove image
        document.getElementById('removeImage').addEventListener('click', function() {
            const imageInput = document.getElementById('patient_image');
            const imagePreview = document.getElementById('imagePreview');
            
            imageInput.value = '';
            imagePreview.src = 'https://via.placeholder.com/150/e2e8f0/4a5568?text=No+Image';
            this.style.display = 'none';
        });

        // Form validation
        document.getElementById('patientForm').addEventListener('submit', function(e) {
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('error');
                } else {
                    field.classList.remove('error');
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Please fill in all required fields');
            }
        });
    </script>
</body>
</html>