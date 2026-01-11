let pdnm = document.getElementById("pdnm");
pdnm.style.visibility = "hidden";

let pwd = document.getElementById("pwd");
let comPwd = document.getElementById("com-pwd");

// Function to validate passwords and update UI
function validatePasswords() {
    let pwdValue = pwd.value.trim();
    let comPwdValue = comPwd.value.trim();

    // Update trimmed values
    pwd.value = pwdValue;
    comPwd.value = comPwdValue;

    // Reset classes
    pwd.classList.remove('error', 'success');
    comPwd.classList.remove('error', 'success');

    // Check if passwords don't match
    if (pwdValue !== comPwdValue && comPwdValue.length > 0) {
        pdnm.innerHTML = "password do not match";
        pdnm.style.cssText = "visibility: visible; color: red;";
        comPwd.classList.add('error');
        if (pwdValue.length >= 6) {
            pwd.classList.add('success');
        }
    } 
    // Check if password is too short
    else if (pwdValue.length > 0 && pwdValue.length < 6) {
        pdnm.innerHTML = "password minimum of 6 characters";
        pdnm.style.cssText = "visibility: visible; color: red;";
        pwd.classList.add('error');
        if (comPwdValue.length > 0) {
            comPwd.classList.add('error');
        }
    } 
    // Passwords match and meet requirements
    else if (pwdValue === comPwdValue && pwdValue.length >= 6) {
        pdnm.innerHTML = "password match";
        pdnm.style.cssText = "visibility: visible; color: green;";
        pwd.classList.add('success');
        comPwd.classList.add('success');
    } 
    // Hide message if fields are empty
    else if (pwdValue.length === 0 && comPwdValue.length === 0) {
        pdnm.style.visibility = "hidden";
    }
}

pwd.addEventListener("keyup", validatePasswords);
comPwd.addEventListener("keyup", validatePasswords);

// Form submission validation
let registerForm = document.getElementById("register-form");
let chkAgree = document.getElementById("chk-agree");

registerForm.addEventListener("submit", (e) => {
    // Check if terms are agreed
    if (!chkAgree.checked) {
        alert("You need to accept the Terms and Conditions!");
        e.preventDefault();
        return;
    }

    // Check if passwords match and meet requirements
    let pwdValue = pwd.value.trim();
    let comPwdValue = comPwd.value.trim();

    if (pwdValue !== comPwdValue) {
        alert("Passwords do not match!");
        e.preventDefault();
        return;
    }

    if (pwdValue.length < 6) {
        alert("Password must be at least 6 characters!");
        e.preventDefault();
        return;
    }
});