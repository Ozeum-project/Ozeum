/**
 * Form validation script for reclamation update
 */
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('edit-reclamation-form');
    
    // Add event listener for form submission
    if (form) {
        form.addEventListener('submit', function(event) {
            // Prevent form submission if validation fails
            if (!validateForm()) {
                event.preventDefault();
            }
        });
    }
    
    // Add event listeners for real-time validation feedback
    const nameInput = document.getElementById('name');
    const titleInput = document.getElementById('title');
    const emailInput = document.getElementById('email');
    const subjectInput = document.getElementById('subject');
    const statusSelect = document.getElementById('status');
    
    // Add blur event listeners for validation when focus leaves an input field
    if (nameInput) {
        nameInput.addEventListener('blur', function() {
            validateName();
        });
    }
   
    if (titleInput) {
        titleInput.addEventListener('blur', function() {
            validateTitle();
        });
    }
    
    if (emailInput) {
        emailInput.addEventListener('blur', function() {
            validateEmail();
        });
    }
    
    if (subjectInput) {
        subjectInput.addEventListener('blur', function() {
            validateSubject();
        });
    }
    
    if (statusSelect) {
        statusSelect.addEventListener('change', function() {
            validateStatus();
        });
    }
    
    /**
     * Validates the entire form
     * @returns {boolean} True if all validations pass, false otherwise
     */
    function validateForm() {
        // Validate each field
        const isNameValid = validateName();
        const isTitleValid = validateTitle();
        const isEmailValid = validateEmail();
        const isSubjectValid = validateSubject();
        const isStatusValid = validateStatus();
        
        // Return true only if all validations pass
        return isNameValid && isTitleValid && isEmailValid && isSubjectValid && isStatusValid;
    }
     
    /**
     * Validates the name field
     * @returns {boolean} True if validation passes, false otherwise
     */
    function validateName() {
        const name = nameInput.value.trim();
        const nameError = document.getElementById('name-error');
        
        if (name === '') {
            nameError.textContent = 'Le nom est requis';
            nameInput.classList.add('input-error');
            return false;
        } else if (name.length < 5) {
            nameError.textContent = 'Le nom doit comporter au moins 5 caractères';
            nameInput.classList.add('input-error');
            return false;
        } else {
            nameError.textContent = '';
            nameInput.classList.remove('input-error');
            return true;
        }
    }


    /**
     * Validates the title field
     * @returns {boolean} True if validation passes, false otherwise
     */
    function validateTitle() {
        const title = titleInput.value.trim();
        const titleError = document.getElementById('title-error');
        
        if (title === '') {
            titleError.textContent = 'Le titre est requis';
            titleInput.classList.add('input-error');
            return false;
        } else if (title.length < 5) {
            titleError.textContent = 'Le titre doit comporter au moins 5 caractères';
            titleInput.classList.add('input-error');
            return false;
        } else {
            titleError.textContent = '';
            titleInput.classList.remove('input-error');
            return true;
        }
    }
    
    /**
     * Validates the email field
     * @returns {boolean} True if validation passes, false otherwise
     */
    function validateEmail() {
        const email = emailInput.value.trim();
        const emailError = document.getElementById('email-error');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (email === '') {
            emailError.textContent = 'L\'email est requis';
            emailInput.classList.add('input-error');
            return false;
        } else if (!emailRegex.test(email)) {
            emailError.textContent = 'L\'email n\'est pas valide';
            emailInput.classList.add('input-error');
            return false;
        } else {
            emailError.textContent = '';
            emailInput.classList.remove('input-error');
            return true;
        }
    }
    
    /**
     * Validates the subject field
     * @returns {boolean} True if validation passes, false otherwise
     */
    function validateSubject() {
        const subject = subjectInput.value.trim();
        const subjectError = document.getElementById('subject-error');
        
        if (subject === '') {
            subjectError.textContent = 'Le sujet est requis';
            subjectInput.classList.add('input-error');
            return false;
        } else if (subject.length < 10) {
            subjectError.textContent = 'Le sujet doit comporter au moins 10 caractères';
            subjectInput.classList.add('input-error');
            return false;}
            else if (subject.length > 100) {
            subjectError.textContent = 'Le sujet ne doit pas dépasser 100 caractères';
        } else {
            subjectError.textContent = '';
            subjectInput.classList.remove('input-error');
            return true;
        }
    }
    
    /**
     * Validates the status field
     * @returns {boolean} True if validation passes, false otherwise
     */
    function validateStatus() {
        const status = statusSelect.value;
        const statusError = document.getElementById('status-error');
        
        if (status === '') {
            statusError.textContent = 'Le statut est requis';
            statusSelect.classList.add('input-error');
            return false;
        } else {
            statusError.textContent = '';
            statusSelect.classList.remove('input-error');
            return true;
        }
    }
});

// Add CSS for error styling
document.addEventListener('DOMContentLoaded', function() {
    // Create a style element
    const style = document.createElement('style');
    
    // Add CSS rules for error styling
    style.textContent = `
        .input-error {
            border-color: #ff4d4d !important;
            background-color: #fff8f8 !important;
        }
        
        .error-message {
            color: #ff4d4d;
            font-size: 12px;
            margin-top: 4px;
            display: block;
        }
        
        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        
        .alert-danger {
            background-color: #fff8f8;
            border: 1px solid #ff4d4d;
            color: #ff4d4d;
        }
    `;
    
    // Append the style element to the head of the document
    document.head.appendChild(style);
});