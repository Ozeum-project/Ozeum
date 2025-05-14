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
            <a href="../../ayoub/index.html">ACCUEIL</a>
            <a href="../../aadel/frontoffice.html">BLOG</a>
            <a href="../../ilyes/front/shop.html">BOUTIQUE</a>
            <a href="../../nour khadouma/formajou.html">AVIS</a>
            <a href="../../ghofrane/accceuil.html">GALLERIE</a>
            <a href="../front/register.html">PROFILE</a>
        </nav>
        <div class="dropdown-menu" id="profile-dropdown">
            <a href="#" class="dropdown-item"><i>👤</i> Modifier Profil</a>
            <!-- <a href="#" class="dropdown-item"><i>🔑</i> Changer Mot de Passe</a> -->
            <a href="#" class="dropdown-item"><i>🚪</i> Se Déconnecter</a>
        </div>
    </header>

   <div class="form-container">
        <h2 class="form-title">Modifier le Profil</h2>
        <form id="profile-form">
            <div class="form-group">
                <label for="name" class="form-label">Nom</label>
                <input type="text" id="name" class="form-input" placeholder="Entrez votre nom " required>
            </div>
              <div class="form-group">
                <label for="prenom" class="form-label">Nom</label>
                <input type="text" id="prenom" class="form-input" placeholder="Entrez votre prenom " required>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Adresse Email</label>
                <input type="email" id="email" class="form-input" placeholder="Entrez votre adresse email" required>
            </div>
            <div class="form-group">
                <label for="phone" class="form-label">Numéro de Téléphone</label>
                <input type="tel" id="phone" class="form-input" placeholder="Entrez votre numéro de téléphone" required>
            </div>
            <div class="form-group">
                <label for="address" class="form-label">Adresse</label>
                <input type="text" id="address" class="form-input" placeholder="Entrez votre adresse" required>
            </div> 
              <div class="form-group">
                <label for="image-upload" class="form-label">Photo de Profil</label>
                <div class="image-preview" id="image-preview">
                    <span>Glissez-déposez une image ici ou cliquez pour télécharger</span>
                    <input type="file" id="image-upload" accept="image/*" style="display: none;">
                </div>
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
            const profileLink = document.getElementById('profile-link');
            const profileDropdown = document.getElementById('profile-dropdown');
            
            profileLink.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation(); // Prevent event from bubbling up
                profileDropdown.classList.toggle('active');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!profileLink.contains(e.target) && !profileDropdown.contains(e.target)) {
                    profileDropdown.classList.remove('active');
                }
            });
            
            // Prevent dropdown from closing when clicking inside it
            profileDropdown.addEventListener('click', function(e) {
                e.stopPropagation();
            });

            // Handle profile form submission
            const profileForm = document.getElementById('profile-form');
            profileForm.addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Profil mis à jour avec succès!');
                // Here you can add code to send the form data to the server
            });

            // Drag and Drop Image Upload
            const imagePreview = document.getElementById('image-preview');
            const imageUpload = document.getElementById('image-upload');

            imagePreview.addEventListener('click', () => imageUpload.click());

            imageUpload.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.innerHTML = `<img src="${e.target.result}" alt="Image Preview" style="width: 100%; height: 100%; object-fit: cover;">`;
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Drag and Drop Events
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
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.innerHTML = `<img src="${e.target.result}" alt="Image Preview" style="width: 100%; height: 100%; object-fit: cover;">`;
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
</body>
</html>