<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.meta')
    @vite('resources/css/reset.css')
    @vite('resources/css/clinic/register.css')
</head>

<body>
            @if(session('success'))
                <p style="color: green"> {{ session('success') }} </p> 
            @elseif(session('info'))
                <p style="color: blue">{{ session('info') }}</p>
            @elseif(session('error'))
                <p style="color: red">{{ session('error') }}</p>
            @endif
             

            <div>
                <h1>Clinic Registration</h1>
                <p>Register your clinic to get started</p>
            </div>

            <div>
                @if ($errors->any())
                    <div>
                        <ul >
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="clinicRegisterForm" action="{{ route('clinic.register') }}" 
                method="POST" enctype="multipart/form-data">
                    @csrf
                    <h2>Logo</h2>
                    <div>
                        <br/>
                        <img id="preview" style="max-width:100px; display:none;">
                        <br/>

                        <label>Select Logo</label>
                        {{-- <input type="file" id="logo" name="logo" accept=".png,.jpg,.jpeg" required/>    --}}
                        <input type="file" id="logo" name="logo" accept=".png" required/>   
                        @error('logo')<span>{{ $message }}</span>@enderror        
                    </div>

                    <br/>
                    <h2>Basic Information</h2>
                        <div>
                            <label for="clinic_id">Clinic ID <span class="required">*</span></label>
                            <input type="text" id="clinic_id" name="clinic_id" value="{{ old('clinic_id') }}" maxlength="4" required placeholder="4-digit ID">
                            @error('clinic_id')<span>{{ $message }}</span>@enderror
                        </div>

                        <div>
                            <label for="clinic_name">Clinic Name <span class="required">*</span></label>
                            <input type="text" id="clinic_name" name="clinic_name" value="{{ old('clinic_name') }}" required placeholder="Enter clinic name">
                            @error('clinic_name')<span>{{ $message }}</span>@enderror
                        </div>
               
                        <div>
                            <label for="clinic_type">Clinic Type <span class="required">*</span></label>
                            <select id="clinic_type" name="clinic_type" required>
                                <option value="">Select clinic type</option>
                                <option value="general" {{ old('clinic_type') == 'general' ? 'selected' : '' }}>General</option>
                                <option value="dental" {{ old('clinic_type') == 'dental' ? 'selected' : '' }}>Dental</option>
                                <option value="diagnostic" {{ old('clinic_type') == 'diagnostic' ? 'selected' : '' }}>Diagnostic</option>
                                <option value="specialty" {{ old('clinic_type') == 'specialty' ? 'selected' : '' }}>Specialty</option>
                                <option value="pediatric" {{ old('clinic_type') == 'pediatric' ? 'selected' : '' }}>Pediatric</option>
                                <option value="surgical" {{ old('clinic_type') == 'surgical' ? 'selected' : '' }}>Surgical</option>
                                <option value="maternity" {{ old('clinic_type') == 'maternity' ? 'selected' : '' }}>Maternity</option>
                                <option value="mental_health" {{ old('clinic_type') == 'mental_health' ? 'selected' : '' }}>Mental Health</option>
                                <option value="rehab" {{ old('clinic_type') == 'rehab' ? 'selected' : '' }}>Rehabilitation</option>
                                <option value="community" {{ old('clinic_type') == 'community' ? 'selected' : '' }}>Community</option>
                                <option value="alternative" {{ old('clinic_type') == 'alternative' ? 'selected' : '' }}>Alternative</option>
                            </select>
                            @error('clinic_type')<span>{{ $message }}</span>@enderror
                        </div>

                        <div>
                            <label for="reg_no">Registration Number <span class="required">*</span></label>
                            <input type="text" id="reg_no" name="reg_no" value="{{ old('reg_no') }}" required placeholder="Enter registration number">
                            @error('reg_no')<span>{{ $message }}</span>@enderror
                        </div>
            
                        <div>
                            <label for="lic_issue_dt">License Issue Date <span class="required">*</span></label>
                            <input type="date" id="lic_issue_dt" name="lic_issue_dt" value="{{ old('lic_issue_dt') }}" required>
                            @error('lic_issue_dt')<span>{{ $message }}</span>@enderror
                        </div>

                        <div>
                            <label for="accred_status">Accreditation Status <span class="required">*</span></label>
                            <select id="accred_status" name="accred_status" required>
                                <option value="none" {{ old('accred_status', 'none') == 'none' ? 'selected' : '' }}>None</option>
                                <option value="pending" {{ old('accred_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="accredited" {{ old('accred_status') == 'accredited' ? 'selected' : '' }}>Accredited</option>
                            </select>
                            @error('accred_status')<span>{{ $message }}</span>@enderror
                        </div>
                
                        <div>
                            <label for="med_dir">Medical Director <span class="required">*</span></label>
                            <input type="text" id="med_dir" name="med_dir" value="{{ old('med_dir') }}" required placeholder="Enter medical director name">
                            @error('med_dir')<span>{{ $message }}</span>@enderror
                        </div>
              
             
                    <br/>
                    <!-- Contact Information -->
                    <h2>Contact Information</h2>
                    
                        <div>
                            <label for="email">Email Address <span class="required">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="clinic@example.com">
                            @error('email')<span>{{ $message }}</span>@enderror
                        </div>

                        <div>
                            <label for="contact_no">Contact Number <span class="required">*</span></label>
                            <input type="text" id="contact_no" name="contact_no" value="{{ old('contact_no') }}" required placeholder="+1234567890">
                            @error('contact_no')<span>{{ $message }}</span>
                            @enderror
                        </div>
                
                        <div>
                            <label for="address">Address <span class="required">*</span></label>
                            <textarea id="address" name="address" required placeholder="Enter complete address">{{ old('address') }}</textarea>
                            @error('address')<span>{{ $message }}</span>@enderror
                        </div>
                  
                        <div>
                            <label for="country_select">Country <span class="required">*</span></label>
                            <select id="country_select" name="country_select" value="{{ old('country') }}"required>
                                <option value="">Select Country</option>
                            </select>
                            <input type="hidden" name="country" id="country_text">
                            @error('country')<span>{{ $message }}</span>@enderror
                        </div>

                        <div>
                            <label for="state_select">State/Province <span class="required">*</span></label>
                            <select id="state_select" name="state_select" required disabled>
                                <option value="">Select State</option>
                            </select>    
                            <input type="hidden" name="state" id="state_text">
                            @error('state')<span>{{ $message }}</span>@enderror
                        </div>

                        <div>
                            <label for="city">City <span class="required">*</span></label>
                            <select id="city" name="city" required disabled>
                                <option value="">Select City</option>
                            </select>
                            @error('city')<span>{{ $message }}</span>@enderror
                        </div>

                    <br/>    
                    <!-- Security -->
                    <h2>Security</h2>
                        <div>
                            <label for="password">Password <span class="required">*</span></label>
                            <input type="password" id="password" name="password" required placeholder="Enter password">
                            @error('password')<span>{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label for="password_confirmation">Confirm Password <span class="required">*</span></label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Confirm password">
                        </div>
                        <span id="pdnm"></span><br>
                  
                    <button type="submit" >Register Clinic</button>
                </form>
            </div>

    <div>
        <a href="{{route('clinic.login') }}">Login here</a><br/>
         <a href="{{route('home') }}">goto home</a>
    </div>


    @vite('resources/js/clinic/register.js')
</body>
</html> 