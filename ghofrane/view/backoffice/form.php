<?php
session_start();
include 'C:\xampp\htdocs\ozeum\ghofrane\controller\galleriecontroller.php';
$error = "";

$offer= null;
// create an instance of the controller
$offerController = new ArtController();


if (
    isset($_POST["artwork-code"],
     $_POST["artwork-name"],
      $_POST["creation-date"],
        $_POST["artist-id"],
         $_POST["category"]) &&
    isset($_FILES["image"])) {
    if (
        !empty($_POST["artwork-code"])  && !empty($_POST["artwork-name"]) && !empty($_POST["creation-date"])  && !empty($_POST["artist-id"]) && !empty($_POST["category"])
    
    ) {
        $disponible = isset($_POST['artwork-dis']) ? "disponible" : "non disponible";
        // Handle the image upload
        $target_dir = "C:\\xampp\\htdocs\\ozeum\\ghofrane\\images\\"; // Double backslash for Windows paths in PHP
        // Extract original file extension
        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

        // Generate a unique file name
        $uniqueName = uniqid('img_', true) . '.' . $imageFileType;

        // Full target path with new unique name
        $target_file = $target_dir . $uniqueName;

        // Check if the file is a real image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            // Attempt to move the uploaded file
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $img = "../../images/" . $uniqueName; // Relative path for DB
            } else {
                $error = "Sorry, there was an error uploading your file.";
            }
        } else {
            $error = "File is not an image.";
        }


        // Only create offer if no errors occurred
        if (!$error) {
            $offer = new Art(
                $_POST['artwork-code'],
                $_POST['artwork-name'],
                new DateTime($_POST['creation-date']),
                $disponible,
                $_POST['artist-id'],
                $_POST['category'],
                $img
            );
            
        $offerController->addOffer($offer);


       header('Location:form.php');
    } else
        $error = "Missing information";
        
}}




?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ozeum - Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="\ozeum\stylefe.css">
    
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
    <div class="logo">ozeum</div>
    <ul class="nav-menu">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                <span>Tableau de bord</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="\ozeum\pro\view\back\eventlist.php" class="nav-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                <span>Évènements</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="\ozeum\adel\view\backoffice\form.php" class="nav-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                </svg>
                <span>Blog</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="\ozeum\saadbouznif\mvc\view\back\users.php" class="nav-link ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                <circle cx="12" cy="7" r="4" />
            </svg>
  
                <span>Visiteurs</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="\ozeum\nour\view\reclamations.php" class="nav-link ">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                </svg>
                <span>Avis et Réclamations</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="\ozeum\ilyes\server\mvc\view\back\boutique.php" class="nav-link ">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                <span>Boutique</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="\ozeum\ghofrane\view\backoffice\form.php" class="nav-link active">
                <!-- https://feathericons.dev/?search=feather&iconset=feather -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z" />
                <line x1="16" x2="2" y1="8" y2="22" />
                <line x1="17.5" x2="9" y1="15" y2="15" />
                </svg>
  
                <span>Gallerie</span>
            </a>
        </li>

    </ul>
</aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="dashboard-header">
            <h1 class="page-title">Gallerie</h1>
            <?php if (isset($_SESSION['user_email'])): ?>
                <a href="#" 
   class="nav-item" 
   id="profile-link"
   style="
       padding: 0.5rem 1rem;
       color: inherit;
       text-decoration: none;
       font-weight: 500;
       transition: color 0.3s ease;
       border-radius: 4px;
   ">
    PROFILE
</a>
            <?php else: ?>
              <a href="/ozeum/saadbouznif/mvc/view/front/signin.php" class="nav-item">LOGIN</a>
            <?php endif; ?>
        </nav>
        <div class="dropdown-menu" id="profile-dropdown">
            <a href="\ozeum\saadbouznif\mvc\view\front\profileInfo.php" class="dropdown-item"><i>👤</i> Mon Compte</a>
            <a href="\ozeum\logout.php" class="dropdown-item"><i>🚪</i> Déconnecter</a>
        </div>
        </header>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-title">Nombre total de pièces</div>
                <div class="stat-value">154</div>
                <div class="stat-change">+8% ce mois</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Nombre total d'artistes</div>
                <div class="stat-value">23</div>
                <div class="stat-change">+5% ce mois</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Taux d'approbation</div>
                <div class="stat-value">92%</div>
                <div class="stat-change">+3% ce mois</div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="dashboard-card">
            <div class="card-header">
                <h2 class="card-title">Vos coordonnées</h2>
                
            </div>
            
            
            <form id="add-artwork-form" action="" method="post" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="ida">Id artiste</label>
                        <input type="text" id="ida" name="artist-id" class="form-input" 
                               placeholder="Votre identifiant">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="p">Nom pièce</label>
                        <input type="text" id="p" name="artwork-name" class="form-input" 
                               placeholder="Nom de l'œuvre">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="d">Date de création</label>
                        <input type="date" id="d" name="creation-date" class="form-input" >
                    </div>
                    
                    
                    <div class="form-group">
                        <label class="form-label" for="c">Code pièce</label>
                        <input type="text" id="c" name="artwork-code" class="form-input" >
                    </div>
                    
                    <div class="form-group full-width">
                        <label class="form-label" for="cat">Catégorie</label>
                        <select id="cat" name="category" class="form-input" >
                            <option value="0">Sélectionnez une catégorie</option>
                                <option value="1">Ceramics</option>
                                <option value="3">karakuri</option>
                                <option value="4">Paintings</option>
                        </select>
                    <div class="form-group">
                        <label class="form-label" for="dis"style="display:inline;margin-right:5px;">disponibilité </label>
                        <input type="checkbox" id="dis" name="artwork-dis"  style="display:inline;">
                    </div>
                    </div>
                    
                    
                    <div class="form-group full-width">
                        <label class="form-label" for="image-upload">Image illustrative</label>
                        <input type="file" accept="image/*" style="display: none;" id="image-upload" name="image" require>
                        <div class="image-preview" id="image-preview" onclick="document.getElementById('image-upload').click()">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                            <span style="margin-left: 10px;">Cliquez ou glissez une image ici</span>
                        </div>
                    </div>
                </div>
                
                <div class="action-buttons">
                    <button type="reset" class="btn btn-secondary">Réinitialiser</button>
                    <button type="submit" class="btn btn-primary">Soumettre</button>
                </div>
            </form>                                                
                                                
            <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                <thead>
                    <tr style="background-color: #f5f5f5; border-bottom: 1px solid #ddd;">
                        <th style="padding: 12px; text-align: left;">Nom art</th>
                        <th style="padding: 12px; text-align: left;">categorie</th>
                        <th style="padding: 12px; text-align: left;">disponibilité</th>
                        <th style="padding: 12px; text-align: left;">Actions</th>
                    </tr>
                </thead>
                <?php
                                            //include '../../controller/galleriecontroller.php';
                                            $TravelOfferC = new ArtController();
                                            $offers=$TravelOfferC->listoffer1();
                                            
                                                
                                                foreach ($offers as $offer) {
                                                    $categorie = match($offer['categorie']) {
                                                        "1", 1 => "Ceramic",
                                                        "3", 3 => "Karakuri",
                                                        "4", 4 => "Peinture",
                                                        default => "Unknown Category"
                                                    };
                                                    echo "<tr>
                                                        <td>{$offer['nom']}</td>
                                                        <td>".$categorie."</td>
                                                        <td style='padding: 12px;'>
                                                        <span style='
                                                        background-color: " . ($offer['disponibilite'] === 'disponible' ? '#27ae60' : '#e74c3c') . ";". 
                                                        "color: white; 
                                                        padding: 4px 8px; 
                                                        border-radius: 4px;
                                                        font-size: 12px;
                                                        '>
                                                        {$offer['disponibilite']}
                                                        </span>
                                                        </td>
                                                        <td style='padding: 12px;'>
                        <a class='btn btn-secondary' style='padding-top: 19px;margin-right:5px;' onclick='showUserDetails(".json_encode($offer).")'>
                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' class='main-grid-item-icon' fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'>
                            <path d='M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z' />
                            <circle cx='12' cy='12' r='3' />
                            </svg>
                        </a>

                        <a class='btn btn-secondary' style='padding-top: 19px;margin-right:5px;' href='modifyform.php?id=".$offer['code']."'>
                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' class='main-grid-item-icon' fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'>
                                <path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z' />
                                </svg>
                        </a>
                        
                        <a class='btn btn-secondary' style='padding-top: 19px;margin-right:5px;' href='deleteOffer.php?id=".$offer['code']."' >
                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' class='main-grid-item-icon' fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'>
                                <path d='M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z' />
                                <line x1='18' x2='12' y1='9' y2='15' />
                                <line x1='12' x2='18' y1='9' y2='15' />
                                </svg>
  
                        </a>
                    </td>
                                                    </tr>";
                                                }
                ?>
                
            </table>
        </div>
    </main>
    <div id="userDetailsModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); align-items: center; justify-content: center;">
        <div class="dashboard-card" style="width: 500px; max-height: 80%; overflow-y: auto;">
            <div class="card-header">
                <h2 class="card-title">Plus de details</h2>
                <button onclick="closeUserModal()" class="btn btn-secondary">Close</button>
            </div>
            <div id="userDetailsContent">
                <!-- User details will be dynamically populated -->
            </div>
        </div>
    </div>
    <?php
        $controller = new ArtController();
        $artistIds = $controller->getAllArtistIds();
        $artCodes = $controller->getAllArtworkCodes();
    ?>
    <script>
    window.artistIds = <?php echo json_encode($controller->getAllArtistIds()); ?>;
    window.artCodes = <?php echo json_encode($controller->getAllArtworkCodes()); ?>;
</script>

    <script src="form.js"></script>

</body>
</html>