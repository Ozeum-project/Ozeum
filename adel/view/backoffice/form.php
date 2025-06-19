<?php 
session_start();
include 'C:\xampp\htdocs\ozeum\adel\controller\blogcontroller.php';

$error = "";

$blog = null;
// create an instance of the controller
$blogController = new BlogController();

if (
    isset($_POST["titre"], $_POST["categorie"], $_POST["statut"], $_POST["auteur"], $_POST["date_publication"], $_POST["contenu"]) &&
    isset($_FILES["image"])) {
    if (
        !empty($_POST["titre"]) && !empty($_POST["categorie"]) && !empty($_POST["statut"]) && 
        !empty($_POST["auteur"]) && !empty($_POST["date_publication"]) && !empty($_POST["contenu"])
    ) {
        // Handle the image upload
        $target_dir = "C:/xampp/htdocs/ozeum/adel/images/";

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
                $img = "../../images/" . $uniqueName; // Relative path for DB
            } else {
                $error = "Sorry, there was an error uploading your file.";
            }
        } else {
            $error = "File is not an image.";
        }

        // Generate a numeric ID for the blog post
        // Using current timestamp as integer ID
        $blog_id = (int)time();

        // Only create blog post if no errors occurred
        if (!$error) {
            $blog = new Blog(
                $blog_id,
                $_POST['titre'],
                $_POST['categorie'],
                $_POST['statut'],
                $_POST['auteur'],
                new DateTime($_POST['date_publication']),
                $_POST['contenu'],
                $img
            );
            
            $blogController->addPost($blog);
            header('Location: form.php');
            exit;
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
            <a href="\ozeum\adel\view\backoffice\form.php" class="nav-link active">
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
            <a href="\ozeum\ilyes\server\mvc\view\back\boutique.php" class="nav-link">
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
            <h1 class="page-title">Gestion des Blogs</h1>
            
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
        </header>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-title">Total des Articles</div>
                <div class="stat-value">42</div>
                <div class="stat-change">+12% ce mois</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Articles Publiés</div>
                <div class="stat-value">36</div>
                <div class="stat-change">+8% ce mois</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Taux d'engagement</div>
                <div class="stat-value">89%</div>
                <div class="stat-change">+5% ce mois</div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="dashboard-card">
            <div class="card-header">
                <h2 class="card-title">Ajouter un Article</h2>
            </div>
            
            <form id="add-blog-form" action="" method="post" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="titre">Titre</label>
                        <input type="text" id="titre" name="titre" class="form-input" 
                               placeholder="Titre de l'article">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="categorie">Catégorie</label>
                        <select id="categorie" name="categorie" class="form-input">
                            <option value="0">Sélectionnez une catégorie</option>
                            <option value="Art">Art</option>
                            <option value="Culture">Culture</option>
                            <option value="Exposition">Exposition</option>
                            <option value="Événement">Événement</option>
                            <option value="Actualité">Actualité</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="statut">Statut</label>
                        <select id="statut" name="statut" class="form-input">
                            <option value="0">Sélectionnez un statut</option>
                            <option value="published">Publié</option>
                            <option value="draft">Brouillon</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="auteur">Auteur</label>
                        <input type="text" id="auteur" name="auteur" class="form-input" 
                               placeholder="Nom de l'auteur">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="date_publication">Date de publication</label>
                        <input type="datetime-local" id="date_publication" name="date_publication" class="form-input">
                    </div>
                    
                    <div class="form-group full-width">
                        <label class="form-label" for="contenu">Contenu</label>
                        <textarea id="contenu" name="contenu" class="form-input" rows="10" 
                                  placeholder="Contenu de l'article..."></textarea>
                    </div>
                    
                    <div class="form-group full-width">
                        <label class="form-label" for="image-upload">Image Thumbnail</label>
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
                    <button type="reset" class="btn btn-secondary">Réinitialiser</button>
                    <button type="submit" class="btn btn-primary">Publier</button>
                </div>
            </form>                                                
                                                
            <table style="width: 100%; border-collapse: separate; border-spacing: 0; margin-top: 25px; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
    <thead>
        <tr style="background-color: var(--primary); color: white;">
            <th style="padding: 15px; text-align: left; font-weight: 500;">Titre</th>
            <th style="padding: 15px; text-align: left; font-weight: 500;">Catégorie</th>
            <th style="padding: 15px; text-align: left; font-weight: 500;">Statut</th>
            <th style="padding: 15px; text-align: left; font-weight: 500;">Auteur</th>
            <th style="padding: 15px; text-align: left; font-weight: 500;">Date</th>
            <th style="padding: 15px; text-align: center; font-weight: 500;">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $blogs = $blogController->listPosts();
        
        foreach ($blogs as $index => $blog) {
            $rowBg = $index % 2 === 0 ? 'background: white;' : 'background: #f9f9f9;';
            echo "<tr style='{$rowBg} border-bottom: 1px solid #eee;'>
                <td style='padding: 15px; vertical-align: middle;'>{$blog['titre']}</td>
                <td style='padding: 15px; vertical-align: middle;'>{$blog['categorie']}</td>
                <td style='padding: 15px; vertical-align: middle;'>
                    <span style='
                        background-color: " . (strtoupper($blog['statut']) === 'PUBLISHED' ? 'var(--success)' : 'var(--accent)') . ";
                        color: white; 
                        padding: 6px 12px; 
                        border-radius: 20px;
                        font-size: 12px;
                        font-weight: 500;
                        display: inline-block;
                        text-transform: uppercase;
                    '>
                    " . (strtoupper($blog['statut']) === 'PUBLISHED' ? 'Publié' : 'Brouillon') . "
                    </span>
                </td>
                <td style='padding: 15px; vertical-align: middle;'>{$blog['auteur']}</td>
                <td style='padding: 15px; vertical-align: middle;'>" . date('d/m/Y H:i', strtotime($blog['date_publication'])) . "</td>
                <td style='padding: 15px; vertical-align: middle; text-align: center;'>
                    <div style='display: inline-flex; gap: 8px; justify-content: center;'>
                        <a class='btn btn-secondary' style='padding: 8px; border-radius: 4px;' onclick='showBlogDetails(".json_encode($blog).")'>
                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='18' height='18' fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'>
                                <path d='M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z' />
                                <circle cx='12' cy='12' r='3' />
                            </svg>
                        </a>

                        <a class='btn btn-secondary' style='padding: 8px; border-radius: 4px;' href='modifyblog.php?id=".$blog['id']."'>
                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='18' height='18' fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'>
                                <path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z' />
                            </svg>
                        </a>
                        
                        <a class='btn btn-secondary' style='padding: 8px; border-radius: 4px;' href='deleteblog.php?id=".$blog['id']."'>
                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='18' height='18' fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'>
                                <path d='M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z' />
                                <line x1='18' x2='12' y1='9' y2='15' />
                                <line x1='12' x2='18' y1='9' y2='15' />
                            </svg>
                        </a>
                    </div>
                </td>
            </tr>";
        }
    ?>
    </tbody>
</table>
        </div>
    </main>

    <!-- Blog Details Modal -->
    <div id="blogDetailsModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); align-items: center; justify-content: center;" onclick="closeBlogModal()">
        <div class="dashboard-card" style="width: 600px; max-height: 80%; overflow-y: auto;" onclick="event.stopPropagation()">
            <div class="card-header">
                <h2 class="card-title">Détails du blog</h2>
                <button onclick="closeBlogModal()" class="btn btn-secondary">Fermer</button>
            </div>
            <div id="blogDetailsContent">
                <!-- Blog details will be dynamically populated -->
            </div>
        </div>
    </div>

    <script src="form.js"></script>
</body>
</html>