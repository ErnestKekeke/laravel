console.log("hello clinic: ");

const API_KEY = "e62260504004159030b227f7925b2c2478d126740ba5e47e208fefec29669bf8"; 

    const countrySelect = document.getElementById('country_select');
    const stateSelect = document.getElementById('state_select');
    const citySelect = document.getElementById('city');
    const form = document.getElementById('clinicRegisterForm');

    // Populate countries on page load
    function populateCountries() {
                // Load Countries
        fetch("https://api.countrystatecity.in/v1/countries", {
            headers: { "X-CSCAPI-KEY": API_KEY }
        })
        .then(res => res.json())
        .then(countries => {
            countries.forEach(country => {
                const option = document.createElement('option');
                option.value = country.iso2;
                option.textContent = country.name;
                countrySelect.appendChild(option);
            });
        });
    }

    // Handle country change
    countrySelect.addEventListener('change', function() {
        const selectedCountry = this.value;
        
        // Reset and disable state and city
        stateSelect.innerHTML = '<option value="">Select State</option>';
        citySelect.innerHTML = '<option value="">Select City</option>';
        stateSelect.disabled = true;
        citySelect.disabled = true;

        if (selectedCountry) {
            fetch(`https://api.countrystatecity.in/v1/countries/${this.value}/states`, {
                headers: { "X-CSCAPI-KEY": API_KEY }
            })
            .then(res => res.json())
            .then(states => {
                states.forEach(state => {
                    const option = document.createElement('option');
                    option.value = state.iso2;
                    option.textContent = state.name;
                    stateSelect.appendChild(option);
                });
            });
            stateSelect.disabled = false;
        }
    });

    // Handle state change
    stateSelect.addEventListener('change', function() {
        // const selectedCountry = countrySelect.value;
        const selectedState = this.value;
        
        const countryCode = countrySelect.value;
        // Reset and disable city
        citySelect.innerHTML = '<option value="">Select City</option>';
        citySelect.disabled = true;

        if (selectedState) {
            fetch(`https://api.countrystatecity.in/v1/countries/${countryCode}/states/${this.value}/cities`, {
                headers: { "X-CSCAPI-KEY": API_KEY }
            })
            .then(res => res.json())
            .then(cities => {
                cities.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.name;
                    option.textContent = city.name;
                    citySelect.appendChild(option);
                });
            });
            citySelect.disabled = false;
        }     
    });

    // Handle form submission
    form.addEventListener('submit', function(e) {
        // e.preventDefault();
        console.log(countrySelect.value);
        console.log(stateSelect.value);
        console.log(citySelect.value);

        
        const countryText = countrySelect.options[countrySelect.selectedIndex].text;
        document.getElementById('country_text').value = countryText;
        const stateText = stateSelect.options[stateSelect.selectedIndex].text;
        document.getElementById('state_text').value = stateText;


        const formData = {
                country: countryText,
                state: stateText,
                city: citySelect.value
            };
        
        console.log(formData);
        console.log(".....................");
    });

    // Initialize
    populateCountries();


    //.............................................
let password = document.getElementById("password");
let passwordConfirmation = document.getElementById("password_confirmation");

// Function to validate passwords and update UI
function validatePasswords() {
    let passwordValue = password.value.trim();
    let passwordConfirmationValue = passwordConfirmation.value.trim();

    // Update trimmed values
    password.value = passwordValue;
    passwordConfirmation.value = passwordConfirmationValue;

    // Reset classes
    // password.classList.remove('error', 'success');
    // passwordConfirmation.classList.remove('error', 'success');

    // Check if passwords don't match
    if (passwordValue !== passwordConfirmationValue && passwordConfirmationValue.length > 0) {
        pdnm.innerHTML = "password do not match";
        pdnm.style.cssText = "visibility: visible; color: red;";
        // passwordConfirmation.classList.add('error');
        if (passwordValue.length >= 6) {
            // password.classList.add('success');
        }
    } 
    // Check if password is too short
    else if (passwordValue.length > 0 && passwordValue.length < 6) {
        pdnm.innerHTML = "password minimum of 6 characters";
        pdnm.style.cssText = "visibility: visible; color: red;";
        // password.classList.add('error');
        if (passwordConfirmationValue.length > 0) {
            // passwordConfirmation.classList.add('error');
        }
    } 
    // Passwords match and meet requirements
    else if (passwordValue === passwordConfirmationValue && passwordValue.length >= 6) {
        pdnm.innerHTML = "password match";
        pdnm.style.cssText = "visibility: visible; color: green;";
        // password.classList.add('success');
        // passwordConfirmation.classList.add('success');
    } 
    // Hide message if fields are empty
    else if (passwordValue.length === 0 && passwordConfirmationValue.length === 0) {
        pdnm.style.visibility = "hidden";
    }
}

password.addEventListener("keyup", validatePasswords);
passwordConfirmation.addEventListener("keyup", validatePasswords);

const logo = document.getElementById('logo');
logo.addEventListener('change', (event)=>{
    const preview = document.getElementById('preview');
    preview.src = URL.createObjectURL(event.target.files[0]);
    preview.style.display = 'block';
})

function previewImage(event) {
    // const preview = document.getElementById('preview');
    // preview.src = URL.createObjectURL(event.target.files[0]);
    // preview.style.display = 'block';
}
