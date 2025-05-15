// Image preview functionality
document.getElementById('image-upload').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (!file) return;
    
    const reader = new FileReader();
    reader.onload = function(e) {
    const preview = document.getElementById('image-preview');
    preview.innerHTML = '';
    preview.style.backgroundImage = `url(${e.target.result})`;
    preview.style.backgroundSize = 'cover';
    preview.style.backgroundPosition = 'center';
    }
    reader.readAsDataURL(file);
});

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('add-event-form');

    form.addEventListener('submit', function(event) {
    event.preventDefault();
    
    // Get form fields
    const title = document.getElementById('title').value.trim();
    const startDate = document.getElementById('start-date').value.trim();
    const startTime = document.getElementById('start-time').value.trim();
    const endDate = document.getElementById('end-date').value.trim();
    const endTime = document.getElementById('end-time').value.trim();
    const location = document.getElementById('location').value.trim();
    const category = document.getElementById('category').value.trim();
    const maxParticipants = document.getElementById('max-participants').value.trim();
    const description = document.getElementById('description').value.trim();
    
    // Remove old messages
    const oldMessages = document.querySelectorAll('.error-message, .approval-message');
    oldMessages.forEach(function(message) {
        message.remove();
    });
    
    
    // Test validation
    let test = true;
    
    // Validate title
    if (title.length < 5) {
        showError('title', 'Le titre doit contenir au moins 5 caractères');
        test = false;
    } else if (!title) {
        showError('title', 'Le titre est requis');
        test = false;
    } else {
        showApproval('title', 'Titre valide');
    }
    
    // Validate dates and times
    if (!startDate) {
        showError('start-date', 'La date de début est requise');
        test = false;
    } else {
        showApproval('start-date', 'Date de début valide');
    }
    
    if (!startTime) {
        showError('start-time', 'L\'heure de début est requise');
        test = false;
    } else {
        showApproval('start-time', 'Heure de début valide');
    }
    
    if (!endDate) {
        showError('end-date', 'La date de fin est requise');
        test = false;
    } else {
        showApproval('end-date', 'Date de fin valide');
    }
    
    if (!endTime) {
        showError('end-time', 'L\'heure de fin est requise');
        test = false;
    } else {
        showApproval('end-time', 'Heure de fin valide');
    }
    
    // Validate location
    if (location.length < 3) {
        showError('location', 'Le lieu doit contenir au moins 3 caractères');
        test = false;
    } else if (!location) {
        showError('location', 'Le lieu est requis');
        test = false;
    } else {
        showApproval('location', 'Lieu valide');
    }
    
    // Validate category
    if (!category) {
        showError('category', 'Veuillez sélectionner une catégorie');
        test = false;
    } else {
        showApproval('category', 'Catégorie valide');
    }
    
    // Validate max participants
    if (maxParticipants && (!maxParticipants.match(/^[0-9]+$/) || parseInt(maxParticipants) < 1)) {
        showError('max-participants', 'Le nombre maximum de participants doit être un nombre positif');
        test = false;
    } else if (!maxParticipants) {
        showError('max-participants', 'Le nombre maximum de participants est requis');
        test = false;
    } else {
        showApproval('max-participants', 'Nombre de participants valide');
    }
    
    // Validate description
    if (description.length < 20) {
        showError('description', 'La description doit contenir au moins 20 caractères');
        test = false;
    } else if (!description) {
        showError('description', 'La description est requise');
        test = false;
    } else {
        showApproval('description', 'Description valide');
    }
    
    // If valid, show success message and reset form
    if (test) {
        alert('Événement publié avec succès!');
        form.submit();
     
    }
    });
       
        // Reset image preview
        document.getElementById('image-preview').style.backgroundImage = '';
        document.getElementById('image-preview').innerHTML = `
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
            <circle cx="8.5" cy="8.5" r="1.5"></circle>
            <polyline points="21 15 16 10 5 21"></polyline>
        </svg>
        <span style="margin-left: 10px;">Cliquez ou glissez une image ici</span>
        `;
    
    // Remove all error and approval messages
    const messages = document.querySelectorAll('.error-message, .approval-message, .success-message');
    messages.forEach(function(message) {
        message.remove();
    });
    // Reset IAMGE
    const imagePreview = document.getElementById('image-preview');
    imagePreview.style.backgroundImage = '';
    imagePreview.innerHTML = `
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
        <circle cx="8.5" cy="8.5" r="1.5"></circle>
        <polyline points="21 15 16 10 5 21"></polyline>
        </svg>
        <span style="margin-left: 10px;">Cliquez ou glissez une image ici</span>
    `;

// Function to show error
function showError(inputId, message) {
    const input = document.getElementById(inputId);                
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.style.color = 'red';
    errorDiv.style.fontSize = '12px';
    errorDiv.style.marginTop = '5px';
    errorDiv.textContent = message;
    // Insert message after the input
    input.parentNode.insertBefore(errorDiv, input.nextSibling);
    }
    
    // Function to show approval
    function showApproval(inputId, message) {
    const input = document.getElementById(inputId);
    const appDiv = document.createElement('div');
    appDiv.className = 'approval-message';
    appDiv.style.color = 'green';
    appDiv.style.fontSize = '12px';
    appDiv.style.marginTop = '5px';
    appDiv.textContent = message;
    // inserer le msg apres l'input
    input.parentNode.insertBefore(appDiv, input.nextSibling);
    }


    });
    
    
