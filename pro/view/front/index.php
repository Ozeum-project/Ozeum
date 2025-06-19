<?php 
session_start();
include '../../controller/eventcontroller.php';
$eventController = new EventController();
$events = $eventController->listEvents();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Musée - Événements à venir</title>
    <link rel="stylesheet" href="\ozeum\stylefe.css">
    
</head>
<body> 
<?php if (isset($_SESSION['user']['role'])): ?>
    <div class="user-role" style="position: fixed; top: 10px; right: 10px; background: #f5f5f5; padding: 5px 10px; border-radius: 4px; z-index: 1000;">
        Connecté en tant que: <strong><?= 
            htmlspecialchars(
                $_SESSION['user']['role'] === 'admin' ? 
                'Administrateur' : 
                'Utilisateur'
            ) 
        ?></strong>
    </div>
<?php endif; ?>


<!-- <div class="top-bar">
        <div>LE MUSÉE EST OUVERT AUJOURD'HUI DE 10H À 17H</div>
        <div>34ÈME AVE, Technopole, Ghazela</div>
    </div> -->

  <header class="header">
        <div class="logo">ozeum</div>
        <nav class="nav">
            <a href="\ozeum\pro\view\front\index.php">ACCUEIL</a>
            <a href="\ozeum\adel\view\frontoffice\blogs.php">BLOG</a>
            <a href="\ozeum\ilyes\server\mvc\view\front\shop.php">BOUTIQUE</a>
            <a href="\ozeum\nour\view\addreclamation.php">AVIS</a>
            <a href="\ozeum\ghofrane\view\frontoffice\acceuil.php">GALLERIE</a>
            <?php if (isset($_SESSION['user_email'])): ?>
                <a href="#" class="nav-item" id="profile-link">PROFILE</a>
            <?php else: ?>
              <a href="/ozeum/saadbouznif/mvc/view/front/signin.php" class="nav-item">LOGIN</a>
            <?php endif; ?>
        </nav>
        <div class="dropdown-menu" id="profile-dropdown">
            <a href="\ozeum\saadbouznif\mvc\view\front\profileInfo.php" class="dropdown-item"><i>👤</i> Mon Compte</a>
            <a href="\ozeum\logout.php" class="dropdown-item"><i>🚪</i> Déconnecter</a>
        </div>
    </header>

    <div class="hero">
        <div class="keyboard">
            <span class="key">A</span>
            <span class="key">c</span>
            <span class="key">c</span>
            <span class="key">u</span>
            <span class="key">e</span>
            <span class="key">i</span>
            <span class="key">l</span>
            <span class="key">/</span>
            <span class="key">É</span>
            <span class="key">v</span>
            <span class="key">é</span>
            <span class="key">n</span>
            <span class="key">e</span>
            <span class="key">m</span>
            <span class="key">e</span>
            <span class="key">n</span>
            <span class="key">t</span>
            <span class="key">s</span>
          </div>
    </div>

    <div class="events-container">
        <div class="search-bar">
            <input type="text" class="search-input" placeholder="Rechercher des événements...">
            <button class="search-button">TROUVER DES ÉVÉNEMENTS</button>
        </div>
        
        <?php foreach ($events as $event): ?>
            <div class='event-card'>
                <div class='event-date'>
                    <div class='event-date-day'><?php echo date('d', strtotime($event['date_debut'])); ?></div>
                    <div class='event-date-month'><?php echo date('M', strtotime($event['date_debut'])); ?></div>
                </div>
                <div class='event-details'>
                    <h2 class='event-title'><?php echo htmlspecialchars($event['titre']); ?></h2>
                    <div class='event-location'><?php echo htmlspecialchars($event['lieu']); ?></div>
                    <div class='event-time'><?php echo htmlspecialchars($event['heure_debut']); ?> - <?php echo htmlspecialchars($event['heure_fin']); ?></div>
                    <div class='event-category'><?php echo htmlspecialchars($event['categorie']); ?></div>
                    <div class='event-participants'>Participants: <?php echo htmlspecialchars($event['nbmax']); ?></div>
                    <p class='event-description'><?php echo htmlspecialchars($event['description']); ?></p>
                    <a href='inscription.html?title=<?php echo urlencode($event['titre']); ?>&date=<?php echo urlencode($event['date_debut']); ?>' class='search-button' style='display: inline-block; margin-top: 15px; text-decoration: none; text-align: center;'>S'inscrire à l'événement</a>
                </div>
                <div class='event-image'>
                    <img src='<?php echo htmlspecialchars($event['img']); ?>' alt='<?php echo htmlspecialchars($event['titre']); ?>' >
                </div>
            </div>
        <?php endforeach; ?>
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
                    <li><a href="#">Événements à Venir</a></li>
                    <li><a href="#">Boutique du Musée</a></li>
                    <li><a href="#">Devenir Membre</a></li>
                    <li><a href="#">Nous Soutenir</a></li>
                    <li><a href="#">Salle de Presse</a></li>
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
        });
    </script>
</body>
</html>