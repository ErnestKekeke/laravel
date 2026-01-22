function openGradeModal(submissionId, studentName, currentScore, currentFeedback) {
    const modal = document.getElementById('gradeModal');
    const form = document.getElementById('gradeForm');
    const studentNameElement = document.getElementById('studentName');
    const scoreInput = document.getElementById('score');
    const feedbackTextarea = document.getElementById('feedback');

    // Set form action
    form.action = `/lecturer/submissions/${submissionId}/grade`;

    // Set student name
    studentNameElement.textContent = studentName;

    // Set current values if available
    if (currentScore !== null) {
        scoreInput.value = currentScore;
    } else {
        scoreInput.value = '';
    }

    if (currentFeedback) {
        feedbackTextarea.value = currentFeedback;
    } else {
        feedbackTextarea.value = '';
    }

    // Show modal
    modal.style.display = 'block';
}

function closeGradeModal() {
    const modal = document.getElementById('gradeModal');
    modal.style.display = 'none';
}

// Close modal when clicking outside of it
window.onclick = function(event) {
    const modal = document.getElementById('gradeModal');
    if (event.target === modal) {
        closeGradeModal();
    }
}

// Close modal on Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeGradeModal();
    }
});