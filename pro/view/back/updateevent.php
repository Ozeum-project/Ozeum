<?php
include '../../controller/eventcontroller.php';

$error = "";
$eventController = new EventController();

// Get event ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch existing event data
$existingEvent = null;
if ($id > 0) {
    $sql = "SELECT * FROM upcommingevents WHERE idd = ?";
    $db = config::getConnexion();
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);
    $existingEvent = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["title"])) {
    // Similar to addevent.php but with update logic
    $img = $existingEvent['img'] ?? '';
    
    if (!empty($_FILES["image"]["name"])) {
        // Handle new image upload
        $target_dir = __DIR__ . "/../../images/";
        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $uniqueName = uniqid('img_', true) . '.' . $imageFileType;
        $target_file = $target_dir . $uniqueName;

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            $error = "Le fichier n'est pas une image.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Delete old image if it exists
                if (!empty($existingEvent['img'])) {
                    $oldImagePath = __DIR__ . '/../../' . $existingEvent['img'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $img = "../../images/" . $uniqueName;
            } else {
                $error = "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
            }
        }
    }

    if (empty($error)) {
        $event = new Event(
                $id,
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

        $eventController->updateEvent($event, $id);
        header('Location: eventList.php');
        exit();
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
            <h2 class="card-title">Modifier l'événement</h2>
        </div>
        
        <?php if (!empty($error)): ?>
            <div class="error-message" style="color: red; margin-bottom: 20px;"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form id="update-event-form" method="POST" action="updateevent.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
            <!-- Form fields with existing values -->
            <div class="form-grid">
                <div class="form-group full-width">
                    <label class="form-label" for="title">Titre de l'événement</label>
                    <input type="text" id="title" name="title" class="form-input" value="<?php echo htmlspecialchars($existingEvent['titre']); ?>">
                </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="start-date">Date de début</label>
                        <input type="date" id="start-date" name="startdate" class="form-input"
                        value="<?php echo htmlspecialchars($existingEvent['date_debut']); ?>" >
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="start-time">Heure de début</label>
                        <input type="time" id="start-time" name="starttime" class="form-input" 
                        value="<?php echo htmlspecialchars($existingEvent['heure_debut']); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="end-date">Date de fin</label>
                        <input type="date" id="end-date" name="enddate" class="form-input" 
                        value="<?php echo htmlspecialchars($existingEvent['date_fin']); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="end-time">Heure de fin</label>
                        <input type="time" id="end-time" name="endtime" class="form-input"
                        value="<?php echo htmlspecialchars($existingEvent['heure_fin']); ?>" >
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="location">Lieu</label>
                        <input type="text" id="location" name="loc" class="form-input"
                        value="<?php echo htmlspecialchars($existingEvent['lieu']); ?>">
                    </div>
                    <?php  $selectcat = $existingEvent['categorie']  ?>
                    <div class="form-group">
                        <label class="form-label" for="category">Catégorie</label>
                        <select id="category" name="category" class="form-input" >
                            <option value="">Sélectionnez une catégorie</option>
                            <option value="exposition" <?= $selectcat == 'exposition' ? 'selected' : '' ?>>Exposition</option>
                            <option value="conference" <?= $selectcat == 'conference' ? 'selected' : '' ?>>Conférence</option>
                            <option value="atelier" <?= $selectcat == 'atelier' ? 'selected' : '' ?>>Atelier</option>
                            <option value="visite" <?= $selectcat == 'visite' ? 'selected' : '' ?>>Visite Guidée</option>
                            <option value="autre" <?= $selectcat == 'autre' ? 'selected' : '' ?>>Autre</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="max-participants">Nombre maximum de participants</label>
                        <input type="number" id="max-participants" name="mxp" class="form-input"
                        value="<?php echo htmlspecialchars($existingEvent['nbmax']); ?>">
                    </div>
                    
                    <div class="form-group full-width">
                        <label class="form-label" for="description">Description</label>
                        <textarea id="description" name="dis" class="form-input"> <?php echo htmlspecialchars($existingEvent['description']); ?></textarea>
                    </div>
                
                <div class="form-group full-width">
                    <label class="form-label">Image de l'événement</label>
                    <input type="file" accept="image/*" style="display: none;" id="image-upload" name="image">
                    <div class="image-preview" id="image-preview" onclick="document.getElementById('image-upload').click()">
                        <?php if (!empty($existingEvent['img'])): ?>
                            <img src="<?php echo htmlspecialchars($existingEvent['img']); ?>" style="max-width: 100%; max-height: 100%;">
                        <?php else: ?>
                            <span style="margin-left: 10px;">Cliquez ou glissez une image ici</span>
                            
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <div class="action-buttons">
                <a href="eventList.php" class="btn btn-secondary">ANNULER</a>
                <button type="submit" class="btn btn-primary">MISE À JOUR</button>
            </div>
        </form>
    </div>
    </main>
    <script src="bcdscript.js"></script>
</body>
</html>