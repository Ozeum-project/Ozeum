<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ozeum - Museum Website</title>
    <link rel="stylesheet" href="stylefe.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="\ozeum\stylefe.css">
    <script src="../backoffice/form.js"></script>
</head>
<body>
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
        </nav>
    </header>


     <div class="hero" style="background-image:url('wallpaperflare.com_wallpaper.jpg');">
        <div class="hero-content">
            <h1>Art Japonaise</h1>
        </div>
    </div>
    
    <div class="collection-filters">
        <a href="acceuil.php" class="filter-btn active">peinture</a>
        <a href="karakuri.php" class="filter-btn">karakuri</a>
        <a href="ceramics.php" class="filter-btn ">ceramic</a>
    </div>
    <div class="blog-divider"></div>
        
    <p class="blog-description">
        La peinture traditionnelle japonaise se caractérise par son raffinement, son minimalisme et son lien étroit avec la nature et la spiritualité. Elle comprend plusieurs styles et techniques    
    </p>
    <main class="shop-container">

        <div class="products-grid">

            <?php
                                                
                                                include '../../controller/galleriecontroller.php';
                                                //include '../config.php';
                                                
                                                $art = new ArtController();
                                                $arts=$art->listoffer1();
                                                

                                                foreach ($arts as $art) {
                                                    if($art['categorie']=='4'){
                                                    $sql = "SELECT artiste.nom
                                                            FROM art
                                                            JOIN artiste ON art.id = artiste.id
                                                            WHERE art.id = :art_id"; // Use a placeholder for the ID

                                                    $db = config::getConnexion();  // Assuming this returns a PDO instance
                                                    $result = $db->prepare($sql);  // Use prepare() instead of query()

                                                    // Bind the value of $art['id'] to the placeholder :art_id
                                                    $result->bindParam(':art_id', $art['id'], PDO::PARAM_INT);

                                                    // Execute the query
                                                    $result->execute();

                                                    // Fetch the result
                                                    if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                        $artistname = $row['nom'];
                                                    }

                                                    echo "
                                                    <div class='blog-item'>
                                                        <div class='blog-image'>
                                                            <img src={$art['image']} alt='contemporary art'>
                                                            <a class='read-more' onclick='showUserDetails(".json_encode($art).")'>voir plus</a>
                                                        </div>
                                                        <div class='blog-content'>
                                                            <h2>{$art['nom']}</h2>
                                                            <div class='blog-category'>{$artistname}</div>
                                                        </div>
                                                    </div>
                                                    <div id='userDetailsModal' class='modal' style='display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); align-items: center; justify-content: center; '>
                                                        <div class='form-container' style='width: 500px; max-height: 80%; overflow-y: auto; '>
                                                            <div class='card-header' style='display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; '>
                                                                <h2 class='form-title'>Plus de details</h2>
                                                                
                                                                <button onclick='closeUserModal()' class='submit-button' style='padding: 10px 20px;'>Fermer</button>
                                                            </div>
                                                            <div id='userDetailsContent'>
                                                                <!-- User details will be dynamically populated -->
                                                            </div>
                                                        </div>
                                                    </div>";
                                                }}
                                                

            ?>

            
        </div>

    </main>
    

    
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
        });
    </script>
</body>
</html>