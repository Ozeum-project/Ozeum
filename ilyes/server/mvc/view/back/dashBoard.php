<?php
// You can connect to your database here if needed
// include 'db.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../../../users.css">
    <style>
        .dashboard-container {
            margin-left: 220px;
            padding: 40px 5%;
        }

        .dashboard-header {
            font-size: 32px;
            font-weight: 300;
            margin-bottom: 30px;
            color: #222;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .stat-card {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
        }

        .stat-title {
            font-size: 16px;
            color: #888;
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 600;
            color: #c4a164;
        }

        .stat-note {
            margin-top: 10px;
            font-size: 13px;
            color: #aaa;
        }
    </style>
</head>
<body>

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
                <a href="../../ilyes/back/boutique.html" class="nav-link active">
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

    <div class="dashboard-container">
        <h1 class="dashboard-header">Admin Dashboard</h1>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-title">Total Products</div>
                <div class="stat-value">154</div>
                <div class="stat-note">Updated today</div>
            </div>

            <div class="stat-card">
                <div class="stat-title">Total Orders</div>
                <div class="stat-value">312</div>
                <div class="stat-note">Last 30 days</div>
            </div>

            <div class="stat-card">
                <div class="stat-title">Registered Users</div>
                <div class="stat-value">87</div>
                <div class="stat-note">Active accounts</div>
            </div>

            <div class="stat-card">
                <div class="stat-title">Revenue</div>
                <div class="stat-value">$12,430</div>
                <div class="stat-note">This month</div>
            </div>
        </div>
    </div>

</body>
</html>
