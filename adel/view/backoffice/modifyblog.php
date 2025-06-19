<?php
include 'C:\xampp\htdocs\ozeum\adel\controller\blogcontroller.php';

$error = "";
$blog = null;

// Create an instance of the controller
$blogController = new BlogController();

// Check if blog ID exists in the URL
if (!isset($_GET['id'])) {
    header('Location: form.php');
    exit();
}

// Get the blog post by ID
$blogPost = $blogController->getPost($_GET['id']);

// If blog post doesn't exist, redirect
if (!$blogPost) {
    header('Location: form.php');
    exit();
}

// Handle form submission
if (
    isset($_POST["titre"], $_POST["categorie"], $_POST["statut"], $_POST["auteur"], $_POST["date_publication"], $_POST["contenu"])
) {
    if (
        !empty($_POST["titre"]) && !empty($_POST["categorie"]) && !empty($_POST["statut"]) && 
        !empty($_POST["auteur"]) && !empty($_POST["date_publication"]) && !empty($_POST["contenu"])
    ) {
        $thumbnail = $blogPost['thumbnail']; // Default to existing thumbnail
        
        // Check if a new image was uploaded
        if (isset($_FILES["image"]) && $_FILES["image"]["size"] > 0) {
            // Handle the image upload
            $target_dir = "C:/xampp/htdocs/adel/images/";

            // Extract original file extension
            $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

            // Generate a unique file name
            $uniqueName = uniqid('blog_', true) . '.' . $imageFileType;

            // Full target path with new unique name
            $target_file = $target_dir . $uniqueName;

            // Check if the file is a real image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                // Attempt to move the uploaded file
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    // Delete the old thumbnail if it exists
                    if (!empty($blogPost['thumbnail'])) {
                        $thumbnailPath = 'C:/xampp/htdocs/adel/images' . substr($blogPost['thumbnail'], 5);
                        
                        if (file_exists($thumbnailPath)) {
                            unlink($thumbnailPath); // Delete the old thumbnail
                        }
                    }
                    
                    $thumbnail = "../../images/" . $uniqueName; // Relative path for DB
                } else {
                    $error = "Sorry, there was an error uploading your file.";
                }
            } else {
                $error = "File is not an image.";
            }
        }

        if (!$error) {
            // Create the updated blog post object
            $blog = new Blog(
                $_GET['id'], // Use the existing ID
                $_POST['titre'],
                $_POST['categorie'],
                $_POST['statut'],
                $_POST['auteur'],
                new DateTime($_POST['date_publication']),
                $_POST['contenu'],
                $thumbnail
            );
            
            // Update the blog post
            $blogController->updatePost($blog, $_GET['id']);
            header('Location: form.php');
            exit();
        }
    } else {
        $error = "Missing information";
    }
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
                <a href="\ozeum\adel\view\backoffice\form.php" class="nav-link active">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                    </svg>
                    <span>Blog</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="\ozeum\saadbouznif\mvc\view\back\users.php" class="nav-link">
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
                <a href="\ozeum\ghofrane\view\backoffice\form.php" class="nav-link">
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
            <h1 class="page-title">Modifier un Article</h1>
            <div class="user-menu">
                <img src="istockphoto-1127367070-612x612.jpg" alt="Admin">
                <span>Administrateur</span>
            </div>
        </header>

        <!-- Form Card -->
        <div class="dashboard-card">
            <div class="card-header">
                <h2 class="card-title">Modifier l'article</h2>
            </div>
            
            <form id="edit-blog-form" action="" method="post" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="titre">Titre</label>
                        <input type="text" id="titre" name="titre" class="form-input" 
                               placeholder="Titre de l'article" value="<?php echo htmlspecialchars($blogPost['titre']); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="categorie">Catégorie</label>
                        <select id="categorie" name="categorie" class="form-input">
                            <option value="0">Sélectionnez une catégorie</option>
                            <option value="Art" <?php echo ($blogPost['categorie'] == 'Art') ? 'selected' : ''; ?>>Art</option>
                            <option value="Culture" <?php echo ($blogPost['categorie'] == 'Culture') ? 'selected' : ''; ?>>Culture</option>
                            <option value="Exposition" <?php echo ($blogPost['categorie'] == 'Exposition') ? 'selected' : ''; ?>>Exposition</option>
                            <option value="Événement" <?php echo ($blogPost['categorie'] == 'Événement') ? 'selected' : ''; ?>>Événement</option>
                            <option value="Actualité" <?php echo ($blogPost['categorie'] == 'Actualité') ? 'selected' : ''; ?>>Actualité</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="statut">Statut</label>
                        <select id="statut" name="statut" class="form-input">
                            <option value="0">Sélectionnez un statut</option>
                            <option value="published" <?php echo ($blogPost['statut'] == 'published') ? 'selected' : ''; ?>>Publié</option>
                            <option value="draft" <?php echo ($blogPost['statut'] == 'draft') ? 'selected' : ''; ?>>Brouillon</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="auteur">Auteur</label>
                        <input type="text" id="auteur" name="auteur" class="form-input" 
                               placeholder="Nom de l'auteur" value="<?php echo htmlspecialchars($blogPost['auteur']); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="date_publication">Date de publication</label>
                        <input type="datetime-local" id="date_publication" name="date_publication" class="form-input" 
                               value="<?php echo date('Y-m-d\TH:i', strtotime($blogPost['date_publication'])); ?>">
                    </div>
                    
                    <div class="form-group full-width">
                        <label class="form-label" for="contenu">Contenu</label>
                        <textarea id="contenu" name="contenu" class="form-input" rows="10" 
                                  placeholder="Contenu de l'article..."><?php echo htmlspecialchars($blogPost['contenu']); ?></textarea>
                    </div>
                    
                    <div class="form-group full-width">
                        <label class="form-label" for="image-upload">Image Thumbnail</label>
                        <input type="file" accept="image/*" style="display: none;" id="image-upload" name="image">
                        <div class="image-preview" id="image-preview" onclick="document.getElementById('image-upload').click()" style="width: 100%; height: 200px; display: flex; justify-content: center; align-items: center; overflow: hidden; border: 1px solid #ccc;">
                            <?php if (!empty($blogPost['thumbnail'])): ?>
                                <img src="<?php echo htmlspecialchars($blogPost['thumbnail']); ?>" alt="Thumbnail" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            <?php else: ?>
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                    <polyline points="21 15 16 10 5 21"></polyline>
                                </svg>
                                <span style="margin-left: 10px;">Cliquez ou glissez une image ici</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="action-buttons">
                    <a href="form.php" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </main>

    <script>


    // Image preview functionality
    document.getElementById('image-upload').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const imagePreview = document.getElementById('image-preview');
                imagePreview.innerHTML = ''; // Clear the old image
                const img = document.createElement('img');
                img.src = event.target.result;
                img.style.maxWidth = '100%';
                img.style.maxHeight = '100%';
                img.style.objectFit = 'contain';
                imagePreview.appendChild(img); // Add the new image
            };
            reader.readAsDataURL(file);
        }
    });

    </script>
    </body>
</html>