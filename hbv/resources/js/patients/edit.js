// Patient Edit Form JavaScript

// Form validation
document.getElementById('patientUpdateForm').addEventListener('submit', function(e) {
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
        return false;
    }

    // Add loading state
    this.classList.add('form-loading');
});

// Remove error class on input
document.querySelectorAll('input, select, textarea').forEach(field => {
    field.addEventListener('input', function() {
        this.classList.remove('error');
    });
});

// Auto-save warning
let formChanged = false;
document.querySelectorAll('input, select, textarea').forEach(field => {
    field.addEventListener('change', function() {
        formChanged = true;
    });
});

// Warn user before leaving if form has changes
window.addEventListener('beforeunload', function(e) {
    if (formChanged) {
        e.preventDefault();
        e.returnValue = 'You have unsaved changes. Are you sure you want to leave?';
        return e.returnValue;
    }
});

// Clear warning on form submit
document.getElementById('patientUpdateForm').addEventListener('submit', function() {
    formChanged = false;
});