<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management Dashboard</title>
    <link rel="stylesheet" href="users.css">
    
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
            <a href="\ozeum\saadbouznif\mvc\view\back\users.php" class="nav-link active">
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
    <div class="main-content">
        <!-- Dashboard Header -->
        <header class="dashboard-header">
            <h1 class="page-title">Gestion d'utilisateurs</h1>
            <?php if (isset($_SESSION['user_email'])): ?>
        <a href="#" id="admin-profile-link">
            
            
        </a>
        <div class="dropdown-menu" id="admin-profile-dropdown">

            <a href="\ozeum\logout.php" class="dropdown-item">Déconnecter</a>
        </div>
    <?php else: ?>
        <a href="/ozeum/saadbouznif/mvc/view/front/signin.php">Connexion</a>
    <?php endif; ?>
        </header>

        <!-- Stats Overview -->
        <section class="stats-grid">
            <div class="stat-card">
                <div class="stat-title">Total Utilisateurs</div>
                <div class="stat-value">1,254</div>
                <div class="stat-change">+3.5% ce mois</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Utilisateurs Active </div>
                <div class="stat-value">987</div>
                <div class="stat-change">+2.1% ce mois</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Utilisateurs bannis</div>
                <div class="stat-value">12</div>
                <div class="stat-change" style="color: #e74c3c;">pas de changement</div>
            </div>
        </section>

        <!-- User Management Card -->
        <div class="dashboard-card">
            <div class="card-header">
                <h2 class="card-title">list d'utilisateurs</h2>
                <div class="action-buttons">
                    <input type="text" class="form-input" placeholder="chercher utilisateurs..." style="width: 250px; margin-right: 10px;">
                    <button class="btn btn-primary">
                         Chercher
                    </button>
                </div>
            </div>

            <!-- User Table -->
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f5f5f5; border-bottom: 1px solid #ddd;">
                        <th style="padding: 12px; text-align: left;">Nom</th>
                        <th style="padding: 12px; text-align: left;">Prenom</th>
                        <th style="padding: 12px; text-align: left;">Email</th>
                        <th style="padding: 12px; text-align: left;">adresse</th>
                        <th style="padding: 12px; text-align: left;">Actions</th>
                    </tr>
                </thead>
                <!--<tbody id="userTableBody">
                     User rows will be dynamically populated by JavaScript 
                </tbody>-->
            </table>
            <table style="width: 100%; border-collapse: collapse;">
            <?php
include 'C:\xampp\htdocs\ozeum\saadbouznif\mvc\controller\usersController.php';
$userc = new UserController();
$users = $userc->listUsers();

foreach ($users as $userData) {
?>
                <tr>
                    <td style="padding: 12px;"><?= htmlspecialchars($userData["name"]) ?>    </td>
                    <td style="padding: 12px;"> <?= htmlspecialchars($userData["lastName"]) ?> </td>
                    <td style="padding: 12px;">   <?= htmlspecialchars($userData["email"]) ?></td>
                    <td style="padding: 12px;">   <?= htmlspecialchars($userData["adresse"]) ?></td>

                   
                
                    <td style="padding: 12px;">
                        <button  class="btn btn-secondary" style="margin-right: 5px;">
                            <!-- https://feathericons.dev/?search=eye&iconset=feather -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                            <circle cx="12" cy="12" r="3" />
                            </svg>
                        </button>
                        <a href="deleteUsers.php?email=<?= urlencode($userData['email']) ?>">
                        <button class="btn btn-secondary">
                            <!-- https://feathericons.dev/?search=delete&iconset=feather -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z" />
                                <line x1="18" x2="12" y1="9" y2="15" />
                                <line x1="12" x2="18" y1="9" y2="15" />
                                </svg>
  
                        </button> 
                        </a>
                    </td>
                </tr>
                
                <?php
}
?>
                
            </table>
        </div>
    </div>

</body>
</html>