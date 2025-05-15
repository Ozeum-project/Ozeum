document.addEventListener('DOMContentLoaded', function() {
    // Add styles for form validation
    const style = document.createElement('style');
    style.textContent = `
        .error-message {
            color: #dc3545;
            font-size: 0.85rem;
            margin-top: 0.25rem;
            display: block;
        }
        .input-error {
            border-color: #dc3545 !important;
        }
        .valid-input {
            border-color: #28a745 !important;
        }
    `;
    document.head.appendChild(style);

    // Get form elements
    const form = document.getElementById('add-reclamation-form');
    const nameInput = document.getElementById('name');
    const titleInput = document.getElementById('title');
    const emailInput = document.getElementById('email');
    const subjectInput = document.getElementById('subject');
    const statusSelect = document.getElementById('status');

    // Real-time validation event listeners
    nameInput.addEventListener('input', validateName);
    titleInput.addEventListener('input', validateTitle);
    emailInput.addEventListener('input', validateEmail);
    subjectInput.addEventListener('input', validateSubject);
    statusSelect.addEventListener('change', validateStatus);

    // Validation functions
    function validateName() {
        const value = nameInput.value.trim();
        clearError(nameInput);
        
        if (value === '') {
            showError(nameInput, 'Please enter your name');
            return false;
        } else if (value.length < 3) {
            showError(nameInput, 'Name must be at least 3 characters');
            return false;
        } else if (!/^[A-Za-zÀ-ÿ\s]+$/.test(value)) {
            showError(nameInput, 'Only letters and spaces are allowed');
            return false;
        } else {
            markValid(nameInput);
            return true;
        }
    }

    function validateTitle() {
        const value = titleInput.value.trim();
        clearError(titleInput);
        
        if (value === '') {
            showError(titleInput, 'Please enter a title for your reclamation');
            return false;
        } else if (value.length < 5) {
            showError(titleInput, 'Title must be at least 5 characters');
            return false;
        } else {
            markValid(titleInput);
            return true;
        }
    }

    function validateEmail() {
        const value = emailInput.value.trim();
        clearError(emailInput);
        
        if (value === '') {
            showError(emailInput, 'Please enter your email');
            return false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
            showError(emailInput, 'Please enter a valid email address');
            return false;
        } else {
            markValid(emailInput);
            return true;
        }
    }

    function validateSubject() {
        const value = subjectInput.value.trim();
        clearError(subjectInput);
        
        if (value === '') {
            showError(subjectInput, 'Please describe your reclamation');
            return false;
        } else if (value.length < 20) {
            showError(subjectInput, 'Description must be at least 10 characters');
            return false;
        } else if (value.length > 500) {
            showError(subjectInput, 'Description must not exceed 500 characters');
            return false;
        } else {
            markValid(subjectInput);
            return true;
        }
    }

    function validateStatus() {
        clearError(statusSelect);
        
        if (statusSelect.value === "0") {
            showError(statusSelect, 'Please select a status');
            return false;
        } else {
            markValid(statusSelect);
            return true;
        }
    }

    // Helper functions
    function showError(input, message) {
        clearError(input);
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.textContent = message;
        input.parentNode.insertBefore(errorDiv, input.nextSibling);
        input.classList.add('input-error');
    }

    function clearError(input) {
        const errorDiv = input.nextElementSibling;
        if (errorDiv && errorDiv.classList.contains('error-message')) {
            errorDiv.remove();
        }
        input.classList.remove('input-error');
        input.classList.remove('valid-input');
    }

    function markValid(input) {
        input.classList.remove('input-error');
        input.classList.add('valid-input');
    }

    // Form submission
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        const isNameValid = validateName();
        const isTitleValid = validateTitle();
        const isEmailValid = validateEmail();
        const isSubjectValid = validateSubject();
        const isStatusValid = validateStatus();

        if (isNameValid && isTitleValid && isEmailValid && 
            isSubjectValid && isStatusValid) {
            form.submit();
        }
    });
});