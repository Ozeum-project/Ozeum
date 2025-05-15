<?php

include 'C:\xampp\htdocs\ozeum\ghofrane\controller\galleriecontroller.php';


$error = "";

$travelOfferC = new ArtController();
$oldoffer = $travelOfferC->showOffer($_GET['id']);

$offer= null;
// create an instance of the controller
$offerController = new ArtController();


if (
    isset($_POST["artwork-code"], $_POST["artwork-name"], $_POST["creation-date"],  $_POST["artist-id"], $_POST["category"]) &&
    isset($_FILES["image"])) {
    if (
        !empty($_POST["artwork-code"])  && !empty($_POST["artwork-name"]) && !empty($_POST["creation-date"]) &&  !empty($_POST["artist-id"]) && !empty($_POST["category"])
    
    ) {
        $disponible = isset($_POST['artwork-dis']) ? "disponible" : "non disponible";

        if(isset($_FILES["image"]) && $_FILES["image"]["size"] <= 0) {
            // If no new image is uploaded, keep the old one
            $img = $oldoffer['image'];
        } else {
            // If a new image is uploaded, process it
            // Handle the image upload
        $target_dir = "E:/xampp/htdocs/2eme esprit/web-project/ghofrane/images/";

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
            // Step 1: Fetch the image path associated with the artwork from the database
            $sql = "SELECT image FROM art WHERE code = ?";
            //$pdo = config::getConnexion();
            $db = config::getConnexion();
            $stmt = $db->prepare($sql);
            $stmt->execute([$_GET['id']]);

         // Fetch the image path
            $artwork = $stmt->fetch();
            $imagePath = $artwork['image'];

            // Step 2: Get the image path starting from the 14th character
            $imageFilePath = 'E:/xampp/htdocs/2eme esprit/web-project/ghofrane' . substr($imagePath, 5);  // Get substring from character 14 onward

            // Check if the file exists before deleting it
            
        if (file_exists($imageFilePath)) {
            unlink($imageFilePath);  // Delete the image
            echo "Image deleted successfully.";
        } else {
            echo "Image not found.";
            echo $imageFilePath;
        }
        }
        
        //---------------------------------------------------
        $offer = new Art(
            $_POST['artwork-code'],
            $_POST['artwork-name'],
            new DateTime($_POST['creation-date']),
            $disponible,
            $_POST['artist-id'],
            $_POST['category'],
            $img
        );
       
           
        $offerController->updateOffer($offer, $offer->getCode());

       header('Location:form.php');
    } else
        $error = "Missing information";
}



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ozeum - Dashboard</title>
    <link rel="stylesheet" href="style.css">
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
                <a href="../../../pro/view/back/eventlist.php" class="nav-link">
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
                <a href="../../aadel/backoffice.html" class="nav-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                    </svg>
                    <span>Blog</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="../../saadbouznif/users.html" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
      
                    <span>Visiteurs</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="../../nour khadouma/feedback.html" class="nav-link ">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                    </svg>
                    <span>Avis et Réclamations</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="../../ilyes/back/boutique.html" class="nav-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    <span>Boutique</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="form.php" class="nav-link active">
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
            <h1 class="page-title">Modifier au gallerie</h1>
            <div class="user-menu">
                <img src="istockphoto-1127367070-612x612.jpg" alt="Admin">
                <span>Administrateur</span>
            </div>
        </header>

        <!-- Form Card -->
        <div class="dashboard-card">
            <div class="card-header">
                <h2 class="card-title">Vos coordonnées</h2>
            </div>
            <?php
   
        $travelOfferC = new ArtController();
        $offer = $travelOfferC->showOffer($_GET['id']);
        $selectcat= $offer['categorie'];

        
       
    ?>
            
            <form id="add-artwork-form" method="post" enctype="multipart/form-data" action="">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="ida">Id artiste</label>
                        <input type="text" id="ida" name="artist-id" class="form-input" 
                         value="<?php echo $offer['id'] ?>">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="p">Nom pièce</label>
                        <input type="text" id="p" name="artwork-name" class="form-input" 
                               value="<?php echo $offer['nom'] ?>">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="d">Date de création</label>
                        <input type="date" id="d" name="creation-date" class="form-input"
                        value ="<?php echo $offer['date'] ?>" >
                    </div>
                    
                    
                    <div class="form-group">
                        <label class="form-label" for="c">Code pièce</label>
                        <input type="text" id="c" name="artwork-code" class="form-input" readonly
                        value="<?php echo $_GET['id'] ?>" >
                    </div>
                    
                    <div class="form-group full-width">
                        <label class="form-label" for="cat">Catégorie</label>
                        <select id="cat" name="category" class="form-input"  >
                            <option value="">Sélectionnez une catégorie</option>
                                <option value="1" <?= $selectcat == '1' ? 'selected' : '' ?>>Ceramics</option>
                                <option value="3" <?= $selectcat == '3' ? 'selected' : '' ?>>karakuri</option>
                                <option value="4" <?= $selectcat == '4' ? 'selected' : '' ?>>Paintings</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="dis" style="display:inline;margin-right:5px;">disponibilité </label>
                        <input type="checkbox" id="dis" name="artwork-dis" style="display:inline;" <?php echo  $offer['disponibilite'] == "disponible" ? 'checked' : ''; ?>>
                    </div>
                    
                    <div class="form-group full-width">
                        <label class="form-label" for="image-upload">Image illustrative</label>
                        <input type="file" accept="image/*" style="display: none;" id="image-upload" name="image" require>
                        <div class="image-preview" id="image-preview" onclick="document.getElementById('image-upload').click()">
                        <img src="<?php echo htmlspecialchars($offer['image']); ?>" style="max-width: 100%; max-height: 100%;">
                        </div>
                    </div>
                </div>
                </div>
                
                <div class="action-buttons">
                    <button type="reset" class="btn btn-secondary">Réinitialiser</button>
                    <button type="submit" class="btn btn-primary">modifier</button>
                </div>
            </form>
        </div>
        <?php
        $controller = new ArtController();
        $artistIds = $controller->getAllArtistIds();
        $artCodes = $controller->getAllArtworkCodes();
    ?>
    </main>
    <script src="update.js"></script>
        <script>
    window.artistIds = <?php echo json_encode($controller->getAllArtistIds()); ?>;
    window.artCodes = <?php echo json_encode($controller->getAllArtworkCodes()); ?>;
    </script>

    

</body>
</html>