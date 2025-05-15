<?php
session_start();
include 'C:\xampp\htdocs\ozeum\saadbouznif\mvc\controller\usersController.php';

$userController = new UserController();

// Get the email from session
$userEmail = $_SESSION['user_email'] ?? null;
$userData = null;

if ($userEmail) {
    $userData = $userController->getUserByEmail($userEmail);
} 

//update user !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $userEmail) {
    // Get posted values
    $name = $_POST['nom'] ?? '';
    $lastName = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';
    $telephone = $_POST['telephone'] ?? '';
    $adresse = $_POST['adresse'] ?? '';
    $image = $userData['image'] ?? '';

    // Handle image upload if a new image is provided
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = "C:/xampp/htdocs/ozeum/saadbouznif/mvc/view/front/images/";        $fileName = uniqid('profile_', true) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $targetFile = $uploadDir . $fileName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $image = $fileName;
        }
    }

    // Update user in database
    $updatedUser = new User(
        $name,
        $lastName,
        $email,
        $userData['password'],
        $image,
        $adresse,
        $telephone
    );
    $userController->updateUser($updatedUser, $userData['email']);

    // Refresh user data after update
    $userData = $userController->getUserByEmail($email);
    $_SESSION['user_email'] = $email;
    echo "<script>alert('Profil mis à jour avec succès!');</script>";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Musée - Événements à venir</title>
    <link rel="stylesheet" href="profileInfo.css">
</head>
<body>
    <div class="top-bar">
        <div>LE MUSÉE EST OUVERT AUJOURD'HUI DE 10H À 17H</div>
        <div>34ÈME AVE, Technopole, Ghazela</div>
    </div>

    <header class="header">
        <div class="logo">ozeum</div>
        <nav class="nav">
            <a href="\ozeum\pro\view\front\index.php">ACCUEIL</a>
            <a href="\ozeum\adel\view\frontoffice\blogs.php">BLOG</a>
            <a href="\ozeum\ilyes\server\mvc\view\front\shop.php">BOUTIQUE</a>
            <a href="\ozeum\nour\view\addreclamation.php">AVIS</a>
            <a href="\ozeum\ghofrane\view\frontoffice\acceuil.php">GALLERIE</a>
          <a href="/ozeum/saadbouznif/mvc/view/front/signin.php" class="nav-item">LOGIN</a>
        </nav>
        <div class="dropdown-menu" id="profile-dropdown">
            <a href="#" class="dropdown-item"><i>👤</i> Modifier Profil</a>
            <!-- <a href="#" class="dropdown-item"><i>🔑</i> Changer Mot de Passe</a> -->
            <a href="#" class="dropdown-item"><i>🚪</i> Se Déconnecter</a>
        </div>
    </header>

   <div class="form-container">
        <h2 class="form-title">Modifier le Profil</h2>
        <form id="profile-form" method="post" enctype="multipart/form-data">

              <div class="form-group">
                <label for="prenom" class="form-label" >Prenom</label>
                <input name="prenom" type="text" id="prenom" class="form-input" placeholder="Entrez votre prenom " value="<?= htmlspecialchars($userData['lastName'] ?? '') ?>" >
            </div>
            <div class="form-group">
                <label for="nom" class="form-label" >Nom</label>
                <input name="nom" type="text" id="nom" class="form-input" placeholder="Entrez votre nom " value="<?= htmlspecialchars($userData['name'] ?? '') ?>" >
                
            </div>
            <div class="form-group">
                <label for="email" class="form-label" >Adresse Email</label>
                <input  name="email" type="email" id="email" class="form-input" placeholder="Entrez votre adresse email" value="<?= htmlspecialchars($userData['email'] ?? '') ?>" readonly >
            </div>
            <div class="form-group">
                <label for="phone" class="form-label" >Numéro de Téléphone</label>
                <input  name="telephone" type="tel" id="phone" class="form-input" placeholder="Entrez votre numéro de téléphone"  value="<?= htmlspecialchars($userData['telephone'] ?? '') ?>" >
            </div>
            <div class="form-group">
                <label for="address" class="form-label" >Adresse</label>
                <input name="adresse" type="text" id="address" class="form-input" placeholder="Entrez votre adresse" value="<?= htmlspecialchars($userData['adresse'] ?? '') ?>" >
            </div> 
              <div class="form-group">
                <label for="image-upload" class="form-label">Photo de Profil</label>
                <div class="image-preview" id="image-preview">
    <?php if (!empty($userData['image'])): ?>
        <img
            src="/ozeum/saadbouznif/mvc/view/front/images/<?= htmlspecialchars($userData['image']) ?>"
            alt="<?= htmlspecialchars($userData['name']) ?>" style="max-width: 200px; max-height: 200px;">
    <?php else: ?>
        <p>No image available</p>
    <?php endif; ?>
</div>   
 <!-- Hidden file input -->
 <input type="file" id="image-upload" name="image" accept="image/*" style="display:none;">
    <!-- Visible button to trigger file input -->
    <!-- <button type="button" class="btn btn-secondary" onclick="document.getElementById('image-upload').click();" style="background-color: #007bff; color: #fff; border: none; padding: 10px 18px; border-radius: 4px; cursor: pointer;" onclick="document.getElementById('image-upload').click();">
        Choisir une nouvelle image
    </button> -->
            </div>
            <button type="submit" class="submit-button">Enregistrer les modifications</button>
        </form>
    </div>

    <footer class="footer">
        <div class="footer-grid">
            <div class="footer-column">
                <h3>VISITEZ-NOUS</h3>
                <div class="contact-info">
                    <p>34ème Ave, Technopole</p>
                    <p> Ghazela</p>
                    <p>Tunis</p>
                    <p>Téléphone : (555) 123-4567</p>
                    <p>Email : info@ozeum.com</p>
                </div>
            </div>

            <div class="footer-column">
                <h3>HEURES D'OUVERTURE</h3>
                <ul class="schedule-list">
                    <li><span>Lundi</span> <span>10H - 17H</span></li>
                    <li><span>Mardi</span> <span>10H - 17H</span></li>
                    <li><span>Mercredi</span> <span>10H - 17H</span></li>
                    <li><span>Jeudi</span> <span>10H - 20H</span></li>
                    <li><span>Vendredi</span> <span>10H - 20H</span></li>
                    <li><span>Week-end</span> <span>10H - 18H</span></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>LIENS RAPIDES</h3>
                <ul class="footer-links">
                    <li><a href="#">Expositions Actuelles</a></li>
                    <li><a href="../ayoub/index.html">Événements à Venir</a></li>
                    <li><a href="../ilyas/front/shop.html">Boutique du Musée</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>NEWSLETTER</h3>
                <p style="margin-bottom: 20px; color: rgba(255, 255, 255, 0.6); font-size: 15px;">Abonnez-vous à notre newsletter pour recevoir des mises à jour sur les nouvelles expositions, événements et plus encore.</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Votre adresse email" class="newsletter-input">
                    <button type="submit" class="newsletter-button">S'abonner</button>
                </form>
            </div>
        </div>

        <div class="footer-bottom">
            <div>&copy; 2025 Ozeum. Tous droits réservés.</div>
            <div class="social-links">
                <a href="#">Facebook</a>
                <a href="#">Twitter</a>
                <a href="#">Instagram</a>
                <a href="#">YouTube</a>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Profile dropdown functionality
    const profileLink = document.getElementById('profile-link');
    const profileDropdown = document.getElementById('profile-dropdown');
    
    if (profileLink) {
        profileLink.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation(); // Prevent event from bubbling up
            profileDropdown.classList.toggle('active');
        });
    }
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (profileLink && profileDropdown && !profileLink.contains(e.target) && !profileDropdown.contains(e.target)) {
            profileDropdown.classList.remove('active');
        }
    });
    
    // Prevent dropdown from closing when clicking inside it
    if (profileDropdown) {
        profileDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }

    // Handle profile form submission with validation
    const profileForm = document.getElementById('profile-form');
    
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
           // e.preventDefault();
            
            // Clear previous error messages
            const oldErrors = document.querySelectorAll('.error-message');
            oldErrors.forEach(function(error) {
                error.remove();
            });
            
            // Get form values
            const name = document.getElementById('nom').value.trim();
            const prenom = document.getElementById('prenom').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const address = document.getElementById('address').value.trim();
            
            // Validation flag
            let isValid = true;

            //validate last name
            if (name===''){
                showError('nom', 'Veuillez saisir votre nom');
                isValid = false;
            }
            
            // Validate name
            if (prenom === '') {
                showError('prenom', 'Veuillez saisir votre prenom');
                isValid = false;
            }
            
            // Validate email
            if (email === '') {
                showError('email', 'Veuillez saisir votre adresse email');
                isValid = false;
            } else if (!isValidEmail(email)) {
                showError('email', 'Veuillez saisir une adresse email valide');
                isValid = false;
            }
            
            // Validate phone number
            if (phone === '') {
                showError('phone', 'Veuillez saisir votre numéro de téléphone');
                isValid = false;
            } else if (!isValidPhone(phone)) {
                showError('phone', 'Veuillez saisir un numéro de téléphone valide (8 chiffres)');
                isValid = false;
            }
            
            // Validate address
            if (address === '') {
                showError('address', 'Veuillez saisir votre adresse');
                isValid = false;
            }
            
           // If validation passes, submit the form
            if (!isValid) {
        e.preventDefault(); // Only prevent if invalid
    }
        });
    }
    
    // Function to validate email format
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    // Function to validate phone number (8 digits for Tunisia)
    function isValidPhone(phone) {
        const phoneRegex = /^[0-9]{8}$/;
        return phoneRegex.test(phone);
    }
    
    // Function to show error messages
    function showError(inputId, message) {
        const input = document.getElementById(inputId);
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.style.color = 'red';
        errorDiv.style.fontSize = '14px';
        errorDiv.style.marginTop = '5px';
        errorDiv.textContent = message;
        
        // Add the error message after the input
        input.parentNode.insertBefore(errorDiv, input.nextSibling);
    }

    // Image upload functionality
    const imagePreview = document.getElementById('image-preview');
    const imageUpload = document.getElementById('image-upload');

    if (imagePreview && imageUpload) {
        // Click on preview area to trigger file input
        imagePreview.addEventListener('click', () => imageUpload.click());
        
        // Handle file selection
        imageUpload.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (!file.type.startsWith('image/')) {
                    showError('image-upload', 'Veuillez sélectionner un fichier image valide');
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.innerHTML = `<img src="${e.target.result}" alt="Image Preview" style="width: 100%; height: 100%; object-fit: cover;">`;
                };
                reader.readAsDataURL(file);
            }
        });
        
        // Drag and drop functionality
        imagePreview.addEventListener('dragover', function(e) {
            e.preventDefault();
            imagePreview.classList.add('dragover');
        });
        
        imagePreview.addEventListener('dragleave', function() {
            imagePreview.classList.remove('dragover');
        });
        
        imagePreview.addEventListener('drop', function(e) {
            e.preventDefault();
            imagePreview.classList.remove('dragover');
            
            const file = e.dataTransfer.files[0];
            if (file) {
                if (!file.type.startsWith('image/')) {
                    showError('image-upload', 'Veuillez sélectionner un fichier image valide');
                    return;
                }
                
                // Update the file input
                imageUpload.files = e.dataTransfer.files;
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.innerHTML = `<img src="${e.target.result}" alt="Image Preview" style="width: 100%; height: 100%; object-fit: cover;">`;
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Newsletter form handling
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
           // e.preventDefault();
            const newsletterEmail = newsletterForm.querySelector('input[type="email"]').value.trim();
            
            if (newsletterEmail === '') {
                alert('Veuillez saisir votre adresse email pour vous abonner à la newsletter');
                return;
            }
            
            if (!isValidEmail(newsletterEmail)) {
                alert('Veuillez saisir une adresse email valide');
                return;
            }
            
            alert('Merci de vous être abonné à notre newsletter!');
            newsletterForm.reset();
        });
    }
});
    </script>
</body>
</html>