<?php
include 'C:\xampp\htdocs\ozeum\nour\controller\reclamationcontroller.php';

$error = "";
$reclamation = null;

// Create an instance of the controller
$reclamationController = new ReclamationController();

// Check if reclamation ID exists in the URL
if (!isset($_GET['id'])) {
    header('Location: reclamations.php');
    exit();
}

// Get the reclamation by ID
$reclamationData = $reclamationController->getReclamation($_GET['id']);

// If reclamation doesn't exist, redirect
if (!$reclamationData) {
    header('Location: reclamations.php');
    exit();
}

// Handle form submission
// ... [previous code remains the same until the form submission check]

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST["name"], $_POST["title"], $_POST["email"], $_POST["subject"], $_POST["status"]) &&
        !empty($_POST["name"]) && !empty($_POST["title"]) && !empty($_POST["email"]) && 
        !empty($_POST["subject"]) && !empty($_POST["status"])
    ) {
        // Create a Reclamation object with the updated data
        $updatedReclamation = new Reclamation(
            $_GET['id'],       // id
            $_POST['name'],    // name
            $_POST['title'],   // title
            $_POST['email'],   // email
            $_POST['subject'], // subject
            $_POST['status']   // status
        );
        
        try {
            // Update the reclamation
            $reclamationController->updateReclamation($updatedReclamation, $_GET['id']);
            header('Location: reclamations.php');
            exit();
        } catch (Exception $e) {
            $error = "Failed to update reclamation: " . $e->getMessage();
        }
    } else {
        $error = "All fields are required";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ozeum - Dashboard</title>
    <link rel="stylesheet" href="modifyreclamation.css">
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
                <a href="../../ayoub/backend/addeventv2.html" class="nav-link">
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
                <a href="../../nour khadouma/feedback.html" class="nav-link active">
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
                <a href="../../ghofrane/backoffice/form.htm" class="nav-link">
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
            <h1 class="page-title">Modifier une Réclamation</h1>
            <div class="user-menu">
                <img src="istockphoto-1127367070-612x612.jpg" alt="Admin">
                <span>Administrateur</span>
            </div>
        </header>

        <!-- Form Card -->
        <div class="dashboard-card">
            <div class="card-header">
                <h2 class="card-title">Modifier la réclamation</h2>
            </div>
            
            <?php if(!empty($error)): ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
            <?php endif; ?>
            
            
            <form id="edit-reclamation-form" action="" method="post">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="name">Nom du Client</label>
                        <input type="text" id="name" name="name" class="form-input" 
                               placeholder="Nom du client" value="<?php echo htmlspecialchars($reclamationData['name']); ?>" >
                        <span class="error-message" id="name-error"></span>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="title">Titre</label>
                        <input type="text" id="title" name="title" class="form-input" 
                               placeholder="Titre de la réclamation" value="<?php echo htmlspecialchars($reclamationData['title']); ?>" >
                        <span class="error-message" id="title-error"></span>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-input" 
                               placeholder="Email de l'expéditeur" value="<?php echo htmlspecialchars($reclamationData['email']); ?>" >
                        <span class="error-message" id="email-error"></span>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="status">Statut</label>
                        <select id="status" name="status" class="form-input">
                            <option value="">Sélectionnez un statut</option>
                            <option value="En attente" <?php echo ($reclamationData['status'] == 'En attente') ? 'selected' : ''; ?>>En attente</option>
                            <option value="En cours" <?php echo ($reclamationData['status'] == 'En cours') ? 'selected' : ''; ?>>En cours</option>
                            <option value="Résolu" <?php echo ($reclamationData['status'] == 'Résolu') ? 'selected' : ''; ?>>Résolu</option>
                        </select>
                        <span class="error-message" id="status-error"></span>
                    </div>
                    
                    <div class="form-group full-width">
                        <label class="form-label" for="subject">Sujet</label>
                        <textarea id="subject" name="subject" class="form-input" rows="8" 
                                  placeholder="Contenu de la réclamation..." required><?php echo htmlspecialchars($reclamationData['subject']); ?></textarea>
                        <span class="error-message" id="subject-error"></span>
                    </div>
                </div>
                
                <div class="action-buttons">
                    <a href="reclamations.php" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>

<!-- Rest of the code remains the same -->
            
        </div>
    </main>

    <script src="form.js"></script>
</body>
</html>