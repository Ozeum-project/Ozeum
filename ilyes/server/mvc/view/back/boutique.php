<?php
include_once 'C:\xampp\htdocs\ozeum\ilyes\server\mvc\controller\couponsController.php';
//getCoupon !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
$couponsController = new CouponsController();
$coupons = $couponsController->getAllCoupons(); 
// addCoupon !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! 

if (isset($_POST['coupon']) && isset($_POST['promotion'])) {
    $couponsController = new CouponsController();
    $couponsController->addCoupon($_POST['coupon'], $_POST['promotion']);
    $_SESSION['coupon_added'] = true;
    // Optional: Redirect to avoid resubmission
    header("Location: boutique.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ozeum Admin - Gérer les Produits</title>
    <link rel="stylesheet" href="../../../../users.css">
</head>
<body> 
<?php if (!empty($_SESSION['coupon_added'])): ?>
    <div style="background:#27ae60; color:#fff; padding:16px; border-radius:6px; margin:24px auto 0 auto; max-width:500px; text-align:center; font-size:1.1rem;">
        Coupon ajouté avec succès !
    </div>
    <?php unset($_SESSION['coupon_added']); ?>
<?php endif; ?>
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
        <?php if (!empty($coupons)): ?>
<div class="coupons-list" style="margin-bottom: 24px; box-shadow: 0 4px 16px rgba(0,0,0,0.08), 0 1.5px 4px rgba(0,0,0,0.06); border-radius: 10px; background: #fff; padding: 32px 28px 24px 28px;">    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <h3 style="margin:0;">Coupons disponible</h3>
        <button class="btn btn-primary" type="button" onclick="openCouponModal()">
          Ajouter un Coupon
      </button>
    </div>
    <table style="width:100%; border-collapse:collapse; background:#fff; border-radius:8px; overflow:hidden;">
        <thead style="background:#f8f8f8;">
            <tr>
                <th style="padding:12px; border-bottom:1px solid #eee; text-align:left;">Code</th>
                <th style="padding:12px; border-bottom:1px solid #eee; text-align:left;">Promotion (%)</th>
                <th style="padding:12px; border-bottom:1px solid #eee; text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($coupons as $coupon): ?>
                <tr style="border-bottom:1px solid #f0f0f0;">
                    <td style="padding:12px;"><?= htmlspecialchars($coupon->getCoupon()) ?></td>
                    <td style="padding:12px; color:#0078d7;"><?= intval($coupon->getPromotion()) ?>%</td>
                    <td style="padding:12px; text-align:right;">
                        <a class='btn btn-secondary' style='padding-top: 19px;margin-right:5px;' href="deleteCoupon.php?id=<?= urlencode($coupon->getId()) ?>" onclick="return confirm('Supprimer ce coupon ?');">
                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' class='main-grid-item-icon' fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'>
                                <path d='M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z' />
                                <line x1='18' x2='12' y1='9' y2='15' />
                                <line x1='12' x2='18' y1='9' y2='15' />
                                </svg>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php else: ?>
    <div class="coupons-list" style="margin-bottom: 24px; box-shadow: 0 4px 16px rgba(0,0,0,0.08), 0 1.5px 4px rgba(0,0,0,0.06); border-radius: 10px; background: #fff; padding: 32px 28px 24px 28px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
            <h3 style="margin:0;">Coupons disponible</h3>
            <button class="btn btn-primary" type="button" onclick="openCouponModal()">
                Ajouter un Coupon
            </button>
        </div>
        <div style="padding: 24px; text-align: center; color: #888;">
            Aucun coupon disponible pour le moment.
        </div>
    </div>
<?php endif; ?>
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
                        <th style="padding: 12px; text-align: right;;">Actions</th>
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
        <td style="padding: 12px; text-align: right;">
              <!-- Bouton Détails (à compléter selon ton projet) -->
              <a class='btn btn-secondary' style='padding-top: 19px;margin-right:5px;' <?php echo "onclick='showUserDetails(".json_encode($productData).")'"; ?>>
                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' class='main-grid-item-icon' fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'>
                            <path d='M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z' />
                            <circle cx='12' cy='12' r='3' />
                            </svg>
                        </a>
            <!-- Bouton Modifier (à compléter selon ton projet) -->
            <a class='btn btn-secondary' style='padding-top: 19px;margin-right:5px;' 
   data-offer='<?= htmlspecialchars(json_encode($offer), ENT_QUOTES, "UTF-8") ?>'
   onclick="showUserDetails(this)">           <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' class='main-grid-item-icon' fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'>
                                <path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z' />
                                </svg>
    </a>
    <!-- Bouton Supprimer -->
    <a href="deleteProduct.php?id=<?= urlencode($productData['id']) ?>" class='btn btn-secondary btn-delete' style='padding-top: 19px;margin-right:5px;'>
    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' class='main-grid-item-icon' fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'>
                                <path d='M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z' />
                                <line x1='18' x2='12' y1='9' y2='15' />
                                <line x1='12' x2='18' y1='9' y2='15' />
                                </svg>
    </a>
        </td>
    </tr>
<?php
}
?>
</tbody> 



</table>


                   
                    
           
        </div>
    </div>
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

    <script>
        // Confirmation de suppression
        document.querySelectorAll(".btn-delete").forEach((button) => {
    button.addEventListener("click", function (event) {
        const productName = this.closest("tr").querySelector("td:nth-child(2)").textContent;
        if (!confirm(`Êtes-vous sûr de vouloir supprimer "${productName}" ?`)) {
            event.preventDefault(); // Stop the link if not confirmed
        }
    });
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

        function openCouponModal() {
    document.getElementById('addCouponModal').style.display = 'block';
}
function closeCouponModal() {
    document.getElementById('addCouponModal').style.display = 'none';
}
window.onclick = function(event) {
    var modal = document.getElementById('addCouponModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
//-------------------------------------------
function showUserDetails(product) {
   

    const modalContent = document.getElementById('userDetailsContent');
    modalContent.innerHTML = `
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">ID</label>
                <input class="form-input" value="${product.id}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Titre</label>
                <input class="form-input" value="${product.titre}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Catégorie</label>
                <input class="form-input" value="${product.category}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Prix Normal</label>
                <input class="form-input" value="${product.prix_normale}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Prix Promotion</label>
                <input class="form-input" value="${product.prix_promotion}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Quantité</label>
                <input class="form-input" value="${product.quantite}" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea class="form-input" readonly>${product.description || ''}</textarea>
            </div>
        </div>
    `;
    document.getElementById('userDetailsModal').style.display = 'flex';
}
// Close User Details Modal
function closeUserModal() {
    document.getElementById('userDetailsModal').style.display = 'none';
}

//-----------------------------------
    </script>
</body> 

<!-- Add Coupon Modal -->
<div id="addCouponModal" class="modal" style="display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%; overflow:auto; background:rgba(0,0,0,0.4);">
  <div style="background:#fff; margin:8% auto; padding:32px 24px; border-radius:8px; width:350px; position:relative;">
    <span onclick="closeCouponModal()" style="position:absolute; top:12px; right:18px; font-size:24px; cursor:pointer;">&times;</span>
    <h2 style="margin-top:0;">Ajouter un Coupon</h2>
    <form method="post" >
      <div style="margin-bottom:16px;">
        <label for="coupon_code">Code du coupon</label>
        <input type="text" id="coupon_code" name="coupon" required style="width:100%; padding:8px; margin-top:4px;">
      </div>
      <div style="margin-bottom:16px;">
        <label for="promotion">Promotion (%)</label>
        <input type="number" id="promotion" name="promotion" min="1" max="100" required style="width:100%; padding:8px; margin-top:4px;">
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%;">Ajouter</button>
    </form>
  </div>
</div>
</html>