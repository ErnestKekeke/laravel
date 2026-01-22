document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.getElementById('role');
    const matricField = document.getElementById('matricField');
    const staffField = document.getElementById('staffField');
    const matricInput = document.getElementById('matric_number');
    const staffInput = document.getElementById('staff_id');

    roleSelect.addEventListener('change', function() {
        const role = this.value;

        if (role === 'student') {
            matricField.style.display = 'block';
            staffField.style.display = 'none';
            matricInput.required = true;
            staffInput.required = false;
            staffInput.value = '';
        } else if (role === 'lecturer') {
            matricField.style.display = 'none';
            staffField.style.display = 'block';
            staffInput.required = true;
            matricInput.required = false;
            matricInput.value = '';
        } else {
            matricField.style.display = 'none';
            staffField.style.display = 'none';
            matricInput.required = false;
            staffInput.required = false;
        }
    });

    // Trigger change event on page load if role is already selected
    if (roleSelect.value) {
        roleSelect.dispatchEvent(new Event('change'));
    }
});