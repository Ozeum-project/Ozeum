<?php

include '../../controller/productController.php';


//$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$error = "";
$product = null;
// Get product ID from URL
$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
// Create an instance of the controller
$productController = new productController();

if (
    isset($_POST["product-title"], $_POST["regular-price"], $_POST["sale-price"], $_POST["product-description"], $_POST["category"], $_POST["stock-quantity"]) &&
    isset($_FILES["product-image"])
) {
    if (
        !empty($_POST["product-id"]) && !empty($_POST["product-title"]) && !empty($_POST["product-description"]) &&
        !empty($_POST["regular-price"]) && !empty($_POST["sale-price"]) &&
        !empty($_POST["stock-quantity"]) && !empty($_POST["category"])
    ) {
        $img = null;

        // Handle the image upload
        $target_dir = "C:/xampp/htdocs/ilyes/server/mvc/view/back/images/";

        if ($_FILES["product-image"]["error"] === UPLOAD_ERR_OK) {
            $imageFileType = strtolower(pathinfo($_FILES["product-image"]["name"], PATHINFO_EXTENSION));
            $uniqueName = uniqid('img_', true) . '.' . $imageFileType;
            $target_file = $target_dir . $uniqueName;

            $check = getimagesize($_FILES["product-image"]["tmp_name"]);
            if ($check !== false) {
                if (move_uploaded_file($_FILES["product-image"]["tmp_name"], $target_file)) {
                    $img = "../back/images/" . $uniqueName;
                } else {
                    $error = "Error uploading the image.";
                }
            } else {
                $error = "Uploaded file is not a valid image.";
            }
        } else {
            // If no new image is uploaded, use the existing one
            $img = $_POST['existing-image'] ?? null;
        }

        // Create or update the product
        $product = new Product(
            intval($_POST["product-id"]),
            $_POST["product-title"],
            $_POST["product-description"],
            floatval($_POST["regular-price"]),
            floatval($_POST["sale-price"]),
            intval($_POST["stock-quantity"]),
            $img,
            $_POST["category"]
        );

        // Now call your controller's update method
        $productController->updateProduct($product, $product->getId());
    } else {
        $error = "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ozeum Admin - Mettre à jour le produit</title> 
    <link rel="stylesheet" href="updateProduct.css">

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
    <main class="main-content">
        <!-- Header -->
        <header class="dashboard-header">
            <h1 class="page-title">Mettre à jour le produit</h1>
            <div class="user-menu">
                <img src="../istockphoto-1127367070-612x612.jpg" alt="Admin">
                <span>Administrateur</span>
            </div>
        </header>
        
        <div class="container">
            <div class="main-content-inner">
            <form method="POST" action="updateProduct.php?id=<?= $productId ?>"enctype="multipart/form-data" id="update-form">
            <?php if (!empty($error)): ?>
                <div class="error-message" style="color: red;"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <?php
            // Initialize controller and get product
            $productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            $productController = new ProductController();
            $product = $productController->getProductById($productId);
            
            // Default product if not found
            if (!$product) {
                $product = [
                    'id' => 0,
                    'titre' => 'Product Not Found',
                    'description' => 'The requested product could not be found.',
                    'image' => '',
                    'prix_normale' => '0.00',
                    'prix_promotion' => '0.00',
                    'quantite' => 0,
                    'category' => 'Unknown'
                ];
            }
            ?>
                <div class="form-group">
                    <label for="product-id">ID du produit</label>
                    <input type="number" name="product-id" id="product-id" value="<?= htmlspecialchars($product['id']) ?>">
                </div>
                <div class="form-group">
                    <label for="product-title">Titre du produit</label>
                    <input name="product-title" type="text" id="product-title" value="<?= htmlspecialchars($product['titre']) ?>">
                </div>
                
                <div class="form-group">
                    <label>Catégories</label>
                    <div class="categories" id="categories">
                        <label><input type="radio" name="category" value="art" <?= $product['category'] === 'art' ? 'checked' : '' ?>> ART</label>
                        <label><input type="radio" name="category" value="book" <?= $product['category'] === 'book' ? 'checked' : '' ?>> LIVRE</label>
                        <label><input type="radio" name="category" value="exhibition" <?= $product['category'] === 'exhibition' ? 'checked' : '' ?>> EXPOSITION</label>
                        <label><input type="radio" name="category" value="painting" <?= $product['category'] === 'painting' ? 'checked' : '' ?>> PEINTURE</label>
                        <label><input type="radio" name="category" value="sculpture" <?= $product['category'] === 'sculpture' ? 'checked' : '' ?>> SCULPTURE</label>
                    </div>
                </div>
                
                <div class="form-group price-inputs">
                    <div>
                        <label for="regular-price">Prix normal (€)</label>
                        <input name="regular-price" type="number" step="0.01" id="regular-price" value="<?= htmlspecialchars($product['prix_normale']) ?>">
                    </div>
                    <div>
                        <label for="sale-price">Prix de vente (€)</label>
                        <input name="sale-price" type="number" step="0.01" id="sale-price" value="<?= htmlspecialchars($product['prix_promotion']) ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="product-description">Description du produit</label>
                    <textarea id="product-description" name="product-description" rows="5"><?= htmlspecialchars($product['description']) ?></textarea>
                </div>
                
                <div class="form-group">
                    <label for="product-image">Image du produit</label>
                    <div class="image-preview">
                        <?php if (!empty($product['image'])): ?>
                            <img src="../back/images/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['titre']) ?>">
                        <?php else: ?>
                            <p>No image available</p>
                        <?php endif; ?>
                    </div>
                    <input name="product-image" type="file" id="product-image" accept="image/*" style="display: none;">
                    <button type="button" class="btn btn-secondary" onclick="document.getElementById('product-image').click()">Changer l'image</button>
                    <!-- Add hidden input for existing image -->
                    <input type="hidden" name="existing-image" value="<?= htmlspecialchars($product['image'] ?? '') ?>">
                </div>
                
                <div class="form-group">
                    <label for="stock-quantity">Quantité en stock</label>
                    <input type="number" name="stock-quantity" id="stock-quantity" value="<?= htmlspecialchars($product['quantite']) ?>">
                </div>
                
                <div class="actions">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='boutique.html'">Annuler</button>
                    <button type="submit" class="btn">Mettre à jour</button>
                </div>
            </form>
            </div>
            
            <div class="sidebar-content">
                <h2>Informations sur le produit</h2>
                
                <div class="product-info">
                    <div class="info-item">
                        <span class="label">ID du produit:</span>
                        <span>1</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Date de création:</span>
                        <span>15 Jan 2025</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Dernière mise à jour:</span>
                        <span>20 Fév 2025</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Ventes totales:</span>
                        <span>24 unités</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Revenu total:</span>
                        <span>288,00 €</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Statut:</span>
                        <span>Actif</span>
                    </div>
                </div>
                
                <h3 style="margin-top: 30px;">Produits associés</h3>
                <div style="display: flex; flex-direction: column; gap: 10px; margin-top: 10px;">
                    <a href="update-product.html?id=2" style="display: flex; align-items: center; text-decoration: none; color: inherit;">
                        <img src="/api/placeholder/50/50" style="margin-right: 10px;">
                        <span>Garçon avec un livre</span>
                    </a>
                    <a href="update-product.html?id=3" style="display: flex; align-items: center; text-decoration: none; color: inherit;">
                        <img src="/api/placeholder/50/50" style="margin-right: 10px;">
                        <span>Rêves abstraits</span>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Preview uploaded image
        document.getElementById('update-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Get form values
    const productTitle = document.getElementById('product-title').value.trim();
    const regularPrice = document.getElementById('regular-price').value;
    const salePrice = document.getElementById('sale-price').value;
    const category = document.querySelector('input[name="category"]:checked')?.value;
    const stockQuantity = document.getElementById('stock-quantity').value;
    const productDescription = document.getElementById('product-description').value.trim();
    
    // Remove any existing error messages
    const oldErrors = document.querySelectorAll('.error-message');
    oldErrors.forEach(function(error) {
        error.remove();
    });
    
    // Check if all fields are filled
    let isValid = true;
    
    // Check product title
    if (productTitle === '' || productTitle.length < 5) {
        showError('product-title', 'Le titre du produit doit contenir au moins 5 caractères.');
        isValid = false;
    }
    
    // Check regular price
    if (regularPrice === '' || parseFloat(regularPrice) <= 0) {
        showError('regular-price', 'Le prix doit être supérieur à 0.');
        isValid = false;
    }
    
    // Check sale price (if provided)
    if (salePrice !== '' && parseFloat(salePrice) <= 0) {
        showError('sale-price', 'Le prix en promotion doit être supérieur à 0.');
        isValid = false;
    }
    
    // Validate sale price is less than regular price
    if (salePrice !== '' && parseFloat(salePrice) >= parseFloat(regularPrice)) {
        showError('sale-price', 'Le prix en promotion doit être inférieur au prix normal.');
        isValid = false;
    }
    
    // Check category
    if (!category) {
        showError('categories', 'Veuillez sélectionner une catégorie.');
        isValid = false;
    }
    
    // Check stock quantity
    if (stockQuantity === '' || parseInt(stockQuantity) < 0) {
        showError('stock-quantity', 'La quantité en stock doit être un nombre positif.');
        isValid = false;
    }
    
    // Check product description
    if (productDescription === '' || productDescription.length < 20) {
        showError('product-description', 'La description doit contenir au moins 20 caractères.');
        isValid = false;
    }
    
    // If everything is valid, submit the form
    if (isValid) {
        this.submit();
    }
});

// Function to show error messages
function showError(fieldId, message) {
    const field = document.getElementById(fieldId);
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.style.color = 'red';
    errorDiv.style.fontSize = '12px';
    errorDiv.style.marginTop = '5px';
    errorDiv.textContent = message;
    field.parentNode.appendChild(errorDiv);
    field.style.borderColor = 'red';
}
    </script>
</body>
</html>