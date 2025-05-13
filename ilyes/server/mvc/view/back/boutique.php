<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ozeum Admin - Gérer les Produits</title>
    <link rel="stylesheet" href="../../../../users.css">
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
                <a href="../../nour khadouma/feedback.html" class="nav-link ">
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
                <a href="../../ghofrane/backoffice/form.html" class="nav-link">
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
            <h1 class="page-title">Gérer les Produits</h1>
            <div class="user-menu">
                <img src="../istockphoto-1127367070-612x612.jpg" alt="Admin">
                <span>Administrateur</span>
            </div>
        </header>

        <!-- Stats Overview -->
        <section class="stats-grid">
            <div class="stat-card">
                <div class="stat-title">Total des Produits</div>
                <div class="stat-value">24</div>
                <div class="stat-change">+12.5% ce mois-ci</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Rupture de Stock</div>
                <div class="stat-value">3</div>
                <div class="stat-change" style="color: #e74c3c;">+1 depuis la semaine dernière</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Revenus</div>
                <div class="stat-value">4 267 €</div>
                <div class="stat-change" style="color: #27ae60;">+15.3% ce mois-ci</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Commandes Récentes</div>
                <div class="stat-value">37</div>
                <div class="stat-change" style="color: #27ae60;">+8.4% cette semaine</div>
            </div>
        </section>

        <!-- Products Management Card -->
        <div class="dashboard-card">
            <div class="card-header">
                <h2 class="card-title">Liste des Produits</h2>
                <div class="action-buttons">
                    <input type="text" class="form-input" placeholder="Rechercher par nom de produit..." style="width: 250px; margin-right: 10px;">
                    <button class="btn btn-primary">
                        <a href="addProduct.php" style="text-decoration: none; color: white;">Ajouter un Nouveau Produit</a>
                        
                    </button>
                </div>
            </div>

            <!-- <div style="margin-bottom: 15px; color: #555;">Affichage de 1 à 8 sur 24 résultats</div> -->

            <!-- Products Table -->
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f5f5f5; border-bottom: 1px solid #ddd;">
                        <th style="padding: 12px; text-align: left;">Image</th>
                        <th style="padding: 12px; text-align: left;">Produit</th>
                        <th style="padding: 12px; text-align: left;">Catégories</th>
                        <th style="padding: 12px; text-align: left;">Prix Normal</th>
                        <th style="padding: 12px; text-align: left;">Prix Promo</th>
                        <th style="padding: 12px; text-align: left;">Stock</th>
                        <th style="padding: 12px; text-align: left;">Actions</th>
                    </tr>
                </thead>
                <tbody>
<?php
include 'C:\xampp\htdocs\ozeum\ilyes\server\mvc\controller\productController.php';
$cartc = new ProductController();
$products = $cartc->listProducts();

foreach ($products as $productData) {
?>
    <tr>
        <td style="padding: 12px;">
            <img src="images/<?= htmlspecialchars($productData["image"]) ?>" alt="Image produit" style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px;">
        </td>
        <td style="padding: 12px;"><?= htmlspecialchars($productData["titre"]) ?></td>
        <td style="padding: 12px;">
            <div style="display: flex; flex-wrap: wrap; gap: 5px;">
                <span style="background-color: #eee; padding: 3px 8px; border-radius: 3px; font-size: 12px;">
                    <?= htmlspecialchars($productData["category"]) ?>
                </span>
            </div>
        </td>
        <td style="padding: 12px;"><?= htmlspecialchars($productData["prix_normale"]) ?></td>
        <td style="padding: 12px;"><?= htmlspecialchars($productData["prix_promotion"]) ?></td>
        <td style="padding: 12px;"><?= htmlspecialchars($productData["quantite"]) ?></td>
        <td style="padding: 12px;">
            <!-- Bouton Modifier (à compléter selon ton projet) -->
            <a  onclick="window.location.href='updateProduct.php?id=<?= $productData['id'] ?>'" >
             
            <button class="btn btn-secondary" style="margin-right: 5px; background-color: #4285f4; color: white;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                    <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path>
                    <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                </svg>
            </button>
            </a>

            <!-- Bouton Supprimer -->
            <a href="deleteProduct.php?id=<?= urlencode($productData['id']) ?>" >
                <button class="btn btn-secondary" style="background-color: #ea4335; color: white;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        <line x1="10" y1="11" x2="10" y2="17"></line>
                        <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>
                </button>
            </a>
        </td>
    </tr>
<?php
}
?>
</tbody>

</table>


                   
                    
            <!-- Pagination -->
            <!-- <div style="display: flex; justify-content: center; margin-top: 20px;">
                <a href="#" style="margin: 0 5px; padding: 8px 12px; border: 1px solid #ddd; text-decoration: none; color: #000; background-color: #f0c14b; border-color: #f0c14b;">1</a>
                <a href="#" style="margin: 0 5px; padding: 8px 12px; border: 1px solid #ddd; text-decoration: none; color: #000;">2</a>
                <a href="#" style="margin: 0 5px; padding: 8px 12px; border: 1px solid #ddd; text-decoration: none; color: #000;">3</a>
                <a href="#" style="margin: 0 5px; padding: 8px 12px; border: 1px solid #ddd; text-decoration: none; color: #000;">Suivant →</a>
            </div> -->
        </div>
    </div>

    <script>
        // Confirmation de suppression
        document.querySelectorAll(".btn-secondary").forEach((button, index) => {
            if (index % 2 !== 0) { // Seulement pour les boutons de suppression (indices impairs)
                button.addEventListener("click", function () {
                    const productName = this.closest("tr").querySelector("td:nth-child(2)").textContent;
                    if (confirm(`Êtes-vous sûr de vouloir supprimer "${productName}" ?`)) {
                        // La logique de suppression irait ici
                        this.closest("tr").remove();
                        alert(`Le produit "${productName}" a été supprimé.`);
                    }
                });
            }
        });

        // Fonctionnalité de recherche
        const searchBox = document.querySelector(".form-input[placeholder='Rechercher par nom de produit...']");
        searchBox.addEventListener("input", function () {
            const searchTerm = this.value.toLowerCase();
            const tableRows = document.querySelectorAll("tbody tr");

            tableRows.forEach((row) => {
                const productName = row.querySelector("td:nth-child(2)").textContent.toLowerCase();
                if (productName.includes(searchTerm)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });

        // Fonctionnalité de tri
        const sortSelect = document.querySelector(".form-input[style*='width: 200px']");
        sortSelect.addEventListener("change", function() {
            const value = this.value;
            const tableRows = Array.from(document.querySelectorAll("tbody tr"));
            
            tableRows.sort((a, b) => {
                const productNameA = a.querySelector("td:nth-child(2)").textContent;
                const productNameB = b.querySelector("td:nth-child(2)").textContent;
                const priceA = parseFloat(a.querySelector("td:nth-child(4)").textContent.replace('€', ''));
                const priceB = parseFloat(b.querySelector("td:nth-child(4)").textContent.replace('€', ''));
                
                if (value === "name-asc") {
                    return productNameA.localeCompare(productNameB);
                } else if (value === "name-desc") {
                    return productNameB.localeCompare(productNameA);
                } else if (value === "price-asc") {
                    return priceA - priceB;
                } else if (value === "price-desc") {
                    return priceB - priceA;
                }
                
                return 0;
            });
            
            const tbody = document.querySelector("tbody");
            tableRows.forEach(row => tbody.appendChild(row));
        });
    </script>
</body>
</html>