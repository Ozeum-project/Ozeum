

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('add-artwork-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        //const artistIds;
        //const artCodes;
        const ida= document.getElementById('ida').value.trim();
        const pieceName = document.getElementById('p').value.trim();
        const date = document.getElementById('d').value;
        const quantity = document.getElementById('s').value;
        const code = document.getElementById('c').value.trim();
        const category = document.getElementById('cat');
        const file = document.getElementById('image-upload');
        
const localArtistIds = window.artistIds;
const localArtCodes = window.artCodes;


        //const file = document.getElementById('file-upload').files;
        
        const oldErrors = document.querySelectorAll('.error-message');
        
        oldErrors.forEach(function(error) {
            error.remove();
        });
        
        // Check if all fields are filled
        let isValid = true;
        
        // Check cid
        if (ida === '' || ida.length != 8) {
            showError('ida', 'veuiller saisir un id de 8 carater ');
            isValid = false;
        }else if (!artistIds.includes(ida)) {
            showError('ida', 'Cet ID d\'artiste n\'existe pas');
            isValid = false;
        }

        // Check piece name
        if (pieceName === '') {
            showError('p', 'veuiller saisir le nom de la piece');
            isValid = false;
        }
        
        // Check date
        if (date === '') {
            showError('d', 'veuiller saisir une date');
            isValid = false;
        }
        
        // Check quantity
        if (quantity === '' || quantity <= 0) {
            showError('s', 'veuiller entrer une quantite ');
            isValid = false;
        }
        
        //check file
        if (!file.files[0]) {
            showError('image-upload','veuiller choisir une photo!');
            //alert('yohoh');
            isValid=false;
        }
        
        
        if (category.value === "0"){
            showError('cat', 'veuiller choisir une categorie');
            isValid = false;
        }
        // If everything is valid, submit the form
        if (isValid) {
            alert('Form is valid, submitting...');
            form.submit();
        }
          
//------------------------unicite ou existance du id et code a faire----------------------------------------

    });   
     
    // Function to show error messages
    function showError(inputId, message) {
        const input = document.getElementById(inputId);
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.style.color = 'red';
        errorDiv.textContent = message;
        
        // Add the error message after the input
        input.parentNode.insertBefore(errorDiv, input.nextSibling);
    }
});
document.addEventListener('DOMContentLoaded', function() {
    const imageUpload = document.getElementById('image-upload');
    const imagePreview = document.getElementById('image-preview');
    
    imageUpload.addEventListener('change', function(event) {
        if (event.target.files && event.target.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                // Clear previous preview content
                imagePreview.innerHTML = '';
                
                // Create image element
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '100%';
                img.style.maxHeight = '100%';
                img.style.backgroundSize = 'cover';
                img.style.backgroundPosition = 'center';
                
                // Add image to preview
                imagePreview.appendChild(img);
            };
            
            reader.readAsDataURL(event.target.files[0]);
        }
    });
    
    // Add drag and drop functionality
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
            imageUpload.files = e.dataTransfer.files;
            const event = new Event('change');
            imageUpload.dispatchEvent(event);
        }
    });
});

//-------- inserting the table content ---------------


function showUserDetails(Art) {
    console.log(Art);
    const modalContent = document.getElementById('userDetailsContent');
    let category;

    switch (Art.categorie) {
        case "1":
        case 1:
            category = "Ceramic";
            break;
        case "3":
        case 3:
            category = "Karakuri";
            break;
        case "4":
        case 4:
            category = "Peinture";
            break;
        default:
            category = "Unknown Category";
    }

    modalContent.innerHTML = `
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">code</label>
                <input class="form-input" value="${Art.code}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">nom</label>
                <input class="form-input" value="${Art.nom}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Date de creation</label>
                <input class="form-input" value="${Art.date}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">quantite</label>
                <input class="form-input" value="${Art.quantite}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">categorie</label>
                <input class="form-input" value="${category}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">id artist</label>
                <input class="form-input" value="${Art.id}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">disponibilite</label>
                <input class="form-input" value="${Art.disponibilite === 'disponible' ? 'disponible' : 'non disponible'} " readonly>
            </div>
        
    `;
    document.getElementById('userDetailsModal').style.display = 'flex';
}

// Close User Details Modal
function closeUserModal() {
    document.getElementById('userDetailsModal').style.display = 'none';
}

