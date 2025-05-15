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
        #image-preview {
            transition: border-color 0.3s ease;
        }
    `;
    document.head.appendChild(style);

    // Get form elements
    const form = document.getElementById('add-blog-form');
    const titleInput = document.getElementById('titre');
    const categorySelect = document.getElementById('categorie');
    const statusSelect = document.getElementById('statut');
    const authorInput = document.getElementById('auteur');
    const dateInput = document.getElementById('date_publication');
    const contentInput = document.getElementById('contenu');
    const fileInput = document.getElementById('image-upload');
    const imagePreview = document.getElementById('image-preview');

    // Real-time validation event listeners
    titleInput.addEventListener('input', validateTitle);
    categorySelect.addEventListener('change', validateCategory);
    statusSelect.addEventListener('change', validateStatus);
    authorInput.addEventListener('input', validateAuthor);
    dateInput.addEventListener('change', validateDate);
    contentInput.addEventListener('input', validateContent);
    fileInput.addEventListener('change', validateImage);

    // Validation functions
    function validateTitle() {
        const value = titleInput.value.trim();
        clearError(titleInput);
        
        if (value === '') {
            showError(titleInput, 'Veuillez saisir un titre pour le blog');
            return false;
        } else if (value.length < 5) {
            showError(titleInput, 'Le titre doit contenir au moins 5 caractères');
            return false;
        } else {
            markValid(titleInput);
            return true;
        }
    }

    function validateCategory() {
        clearError(categorySelect);
        
        if (categorySelect.value === "0") {
            showError(categorySelect, 'Veuillez choisir une catégorie');
            return false;
        } else {
            markValid(categorySelect);
            return true;
        }
    }

    function validateStatus() {
        clearError(statusSelect);
        
        if (statusSelect.value === "0") {
            showError(statusSelect, 'Veuillez choisir un statut');
            return false;
        } else {
            markValid(statusSelect);
            return true;
        }
    }

    function validateAuthor() {
        const value = authorInput.value.trim();
        clearError(authorInput);
        
        if (value === '') {
            showError(authorInput, 'Veuillez saisir un nom d\'auteur');
            return false;
        } else if (value.length < 3) {
            showError(authorInput, 'Le nom de l\'auteur doit contenir au moins 3 caractères');
            return false;
        } else if (!/^[A-Za-zÀ-ÿ\s]+$/.test(value)) {
            showError(authorInput, 'Seules les lettres et les espaces sont autorisés');
            return false;
        } else {
            markValid(authorInput);
            return true;
        }
    }

    function validateDate() {
        clearError(dateInput);
        
        if (dateInput.value === '') {
            showError(dateInput, 'Veuillez saisir une date de publication');
            return false;
        } else {
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            const selectedDate = new Date(dateInput.value);
            
            if (selectedDate > today) {
                showError(dateInput, 'La date de publication doit être antérieure ou égale à la date d\'aujourd\'hui');
                return false;
            } else {
                markValid(dateInput);
                return true;
            }
        }
    }

    function validateContent() {
        const value = contentInput.value.trim();
        clearError(contentInput);
        
        if (value === '') {
            showError(contentInput, 'Veuillez saisir le contenu du blog');
            return false;
        } else if (value.length < 20) {
            showError(contentInput, 'Le contenu doit contenir au moins 20 caractères');
            return false;
        } else if (value.length > 1000) {
            showError(contentInput, 'Le contenu ne doit pas dépasser 1000 caractères');
            return false;
        } else {
            markValid(contentInput);
            return true;
        }
    }

    function validateImage() {
        clearError(fileInput);
        
        if (!fileInput.files[0]) {
            showError(fileInput, 'Veuillez choisir une image de thumbnail');
            return false;
        } else {
            markValid(fileInput);
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
        
        const isTitleValid = validateTitle();
        const isCategoryValid = validateCategory();
        const isStatusValid = validateStatus();
        const isAuthorValid = validateAuthor();
        const isDateValid = validateDate();
        const isContentValid = validateContent();
        const isImageValid = validateImage();

        if (isTitleValid && isCategoryValid && isStatusValid && 
            isAuthorValid && isDateValid && isContentValid && isImageValid) {
            form.submit();
        }
    });

    // Image preview functionality
    fileInput.addEventListener('change', function(event) {
        if (event.target.files && event.target.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                imagePreview.innerHTML = '';
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '100%';
                img.style.maxHeight = '100%';
                img.style.backgroundSize = 'cover';
                img.style.backgroundPosition = 'center';
                
                imagePreview.appendChild(img);
            };
            
            reader.readAsDataURL(event.target.files[0]);
        }
    });
    
    // Drag and drop functionality
    imagePreview.addEventListener('dragover', function(e) {
        e.preventDefault();
        imagePreview.style.borderColor = '#007bff';
    });
    
    imagePreview.addEventListener('dragleave', function() {
        imagePreview.style.borderColor = '#dee2e6';
    });
    
    imagePreview.addEventListener('drop', function(e) {
        e.preventDefault();
        imagePreview.style.borderColor = '#dee2e6';
        
        if (e.dataTransfer.files && e.dataTransfer.files[0]) {
            fileInput.files = e.dataTransfer.files;
            const event = new Event('change');
            fileInput.dispatchEvent(event);
        }
    });
});

// Blog details modal functions
function showBlogDetails(blog) {
    const modalContent = document.getElementById('blogDetailsContent');
    
    modalContent.innerHTML = `
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">ID</label>
                <input class="form-input" value="${blog.id}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Titre</label>
                <input class="form-input" value="${blog.titre}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Catégorie</label>
                <input class="form-input" value="${blog.categorie}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Statut</label>
                <input class="form-input" value="${blog.statut}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Auteur</label>
                <input class="form-input" value="${blog.auteur}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Date de publication</label>
                <input class="form-input" value="${blog.date_publication}" readonly>
            </div>
            <div class="form-group full-width">
                <label class="form-label">Contenu</label>
                <textarea class="form-input" readonly style="height: 150px;">${blog.contenu}</textarea>
            </div>
            <div class="form-group full-width">
                <label class="form-label">Thumbnail</label>
                <div style="max-width: 200px; margin-top: 10px;">
                    <img src="${blog.thumbnail}" style="width: 100%; height: auto;">
                </div>
            </div>
        </div>
    `;
    document.getElementById('blogDetailsModal').style.display = 'flex';
}

function closeBlogModal() {
    document.getElementById('blogDetailsModal').style.display = 'none';
}