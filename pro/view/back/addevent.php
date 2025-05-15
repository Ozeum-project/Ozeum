<?php
include '../../controller/eventcontroller.php';
echo 'smthing';
$error = "";
$event=null;
$eventController = new EventController();

if (isset($_POST["title"] , 
    $_POST["startdate"] , 
    $_POST["starttime"] , 
    $_POST["enddate"] , 
    $_POST["endtime"] , 
    $_POST["loc"] , 
    $_POST["category"] , 
    $_POST["mxp"], 
    $_POST["dis"])&& 
    isset($_FILES["image"])) {
    
    if (!empty($_POST["title"]) && 
        !empty($_POST["startdate"]) && 
        !empty($_POST["starttime"]) && 
        !empty($_POST["enddate"]) && 
        !empty($_POST["endtime"]) && 
        !empty($_POST["loc"]) && 
        !empty($_POST["category"]) && 
        !empty($_POST["mxp"]) && 
        !empty($_POST["dis"]) && 
        !empty($_FILES["image"]["name"])) {

        // Image upload handling
        $target_dir = "E:/xampp/htdocs/2eme esprit/web-project/pro/images/";
        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $uniqueName = uniqid('img_', true) . '.' . $imageFileType;
        $target_file = $target_dir . $uniqueName;

        // Check if image is valid
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            $error = "Le fichier n'est pas une image.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $img = "../../images/" . $uniqueName;
            } else {
                $error = "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
            }
        }

        if (!$error) {
            $event = new Event(
                null,
                $_POST["title"],
                new DateTime($_POST["startdate"]),
                new DateTime($_POST["starttime"]),
                new DateTime($_POST["enddate"]),
                new DateTime($_POST["endtime"]),
                $_POST["loc"],
                $_POST["category"],
                $_POST["mxp"],
                $_POST["dis"],
                $img
            );

            $eventController->addEvent($event);
            header('Location: eventList.php');
            //exit();
        }
    } 
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <title>Ozeum - Dashboard</title>
    <link rel="stylesheet" href="bcdstyle.css"> 
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
                <a href="eventlist.php" class="nav-link active">
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
                <a href="../../../ghofrane/view/backoffice/form.php" class="nav-link ">
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
            <h1 class="page-title">Événements</h1>
            <div class="user-menu">
                <span>Admin</span>
            </div>
        </header>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-title">TOTAL ÉVÉNEMENTS</div>
                <div class="stat-value">42</div>
                <div class="stat-change">+12% ce mois</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">ÉVÉNEMENTS ACTIFS</div>
                <div class="stat-value">18</div>
                <div class="stat-change">+5% ce mois</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">INSCRIPTIONS</div>
                <div class="stat-value">1,245</div>
                <div class="stat-change">+16% ce mois</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">TAUX DE PARTICIPATION</div>
                <div class="stat-value">78%</div>
                <div class="stat-change">+3% ce mois</div>
            </div>
        </div>


    <!-- Form Card -->
    <div class="dashboard-card">
        <div class="card-header">
            <h2 class="card-title">Ajouter un nouvel événement</h2>
        </div>
        
        
        <form id="add-event-form" method="POST" action="" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label class="form-label" for="title">Titre de l'événement</label>
                        <input type="text" id="title" name="title" class="form-input">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="start-date">Date de début</label>
                        <input type="date" id="start-date" name="startdate" class="form-input" >
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="start-time">Heure de début</label>
                        <input type="time" id="start-time" name="starttime" class="form-input" >
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="end-date">Date de fin</label>
                        <input type="date" id="end-date" name="enddate" class="form-input" >
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="end-time">Heure de fin</label>
                        <input type="time" id="end-time" name="endtime" class="form-input" >
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="location">Lieu</label>
                        <input type="text" id="location" name="loc" class="form-input">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="category">Catégorie</label>
                        <select id="category" name="category" class="form-input" >
                            <option value="">Sélectionnez une catégorie</option>
                            <option value="exposition">Exposition</option>
                            <option value="conference">Conférence</option>
                            <option value="atelier">Atelier</option>
                            <option value="visite">Visite Guidée</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="max-participants">Nombre maximum de participants</label>
                        <input type="number" id="max-participants" name="mxp" class="form-input">
                    </div>
                    
                    <div class="form-group full-width">
                        <label class="form-label" for="description">Description</label>
                        <textarea id="description" name="dis" class="form-input"> </textarea>
                    </div>
                    
                    <div class="form-group full-width">
                        <label class="form-label">Image de l'événement</label>
                        <input type="file" accept="image/*" style="display: none;" id="image-upload" name="image">
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
                    <input type="reset" class="btn btn-secondary" value="ANNULER">
                    <button type="submit" class="btn btn-primary">PUBLIER L'ÉVÉNEMENT</button>
                </div>
            
        </form>
    </div>

    <script src="bcdscript.js"></script>
</body>
</html>