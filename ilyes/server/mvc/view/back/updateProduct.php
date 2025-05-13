<?php
session_start(); // For CSRF protection and potential user sessions

include '../../controller/productController.php';
//include '../../mvc/model/productModel.php'; // Ensure Product class is available

// Initialize variables
$error = "";
$success = "";
$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$productController = new ProductController();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token (recommended for security)
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error = "Invalid form submission.";
    } elseif (
        isset(
            $_POST["product-id"],
            $_POST["product-title"],
            $_POST["regular-price"], 
            $_POST["sale-price"],
            $_POST["product-description"],
            $_POST["category"],
            $_POST["stock-quantity"]
        )
    ) {
        // Validate required fields
        $requiredFields = [
            'product-id' => 'Product ID',
            'product-title' => 'Product Title',
            'regular-price' => 'Regular Price',
            'sale-price' => 'Sale Price',
            'product-description' => 'Description',
            'category' => 'Category',
            'stock-quantity' => 'Stock Quantity'
        ];

        $missingFields = [];
        foreach ($requiredFields as $field => $name) {
            if (empty($_POST[$field])) {
                $missingFields[] = $name;
            }
        }

        if (!empty($missingFields)) {
            $error = "Missing required fields: " . implode(', ', $missingFields);
        } else {
            // Handle image upload
            $img = $_POST['existing-image'] ?? ''; // Default to existing image

            if (isset($_FILES["product-image"]) && $_FILES["product-image"]["error"] === UPLOAD_ERR_OK) {
                $target_dir = "C:/xampp/htdocs/ilyes/server/mvc/view/back/images/";
                
                // Validate image
                $check = getimagesize($_FILES["product-image"]["tmp_name"]);
                if ($check === false) {
                    $error = "Uploaded file is not a valid image.";
                } else {
                    // Generate unique filename
                    $imageFileType = strtolower(pathinfo($_FILES["product-image"]["name"], PATHINFO_EXTENSION));
                    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                    
                    if (!in_array($imageFileType, $allowedTypes)) {
                        $error = "Only JPG, JPEG, PNG & GIF files are allowed.";
                    } else {
                        $uniqueName = uniqid('img_', true) . '.' . $imageFileType;
                        $target_file = $target_dir . $uniqueName;

                        if (move_uploaded_file($_FILES["product-image"]["tmp_name"], $target_file)) {
                            $img = $uniqueName; // Store only filename
                            
                            // Delete old image if it exists and is different
                            if (!empty($_POST['existing-image']) && $_POST['existing-image'] !== $img) {
                                $oldImagePath = $target_dir . basename($_POST['existing-image']);
                                if (file_exists($oldImagePath)) {
                                    unlink($oldImagePath);
                                }
                            }
                        } else {
                            $error = "Sorry, there was an error uploading your file.";
                        }
                    }
                }
            }

            // If no errors, proceed with update
            if (empty($error)) {
                try {
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

                    // Validate sale price is less than regular price
                    if ($product->getPrixPromotion() >= $product->getPrixNormale()) {
                        $error = "Sale price must be less than regular price.";
                    } else {
                        $productController->updateProduct($product, $product->getId());
                        $success = "Product updated successfully!";
                        
                        // Refresh product data
                        $product = $productController->getProductById($product->getId());
                    }
                } catch (Exception $e) {
                    $error = "Error updating product: " . $e->getMessage();
                }
            }
        }
    } else {
        $error = "Invalid form data submitted.";
    }
}

// Load product data (either initial load or after failed update)
if (!isset($product)) { // Only load if not already set from form submission
    $product = $productController->getProductById($productId);
}

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

// Generate CSRF token for form
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
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

    <main class="main-content">
        <header class="dashboard-header">
            <h1 class="page-title">Mettre à jour le produit</h1>
            <div class="user-menu">
                <img src="../istockphoto-1127367070-612x612.jpg" alt="Admin">
                <span>Administrateur</span>
            </div>
        </header>
        
        <div class="container">
            <div class="main-content-inner">
                <?php if (!empty($error)): ?>
                    <div class="error-message" style="color: red; padding: 10px; margin-bottom: 15px; border: 1px solid red;">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php elseif (!empty($success)): ?>
                    <div class="success-message" style="color: green; padding: 10px; margin-bottom: 15px; border: 1px solid green;">
                        <?= htmlspecialchars($success) ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="updateProduct.php?id=<?= $productId ?>" enctype="multipart/form-data" id="update-form">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    
                    <div class="form-group">
                        <label for="product-id">ID du produit</label>
                        <input type="number" name="product-id" id="product-id" value="<?= htmlspecialchars($product['id']) ?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="product-title">Titre du produit</label>
                        <input name="product-title" type="text" id="product-title" value="<?= htmlspecialchars($product['titre']) ?>" required minlength="5">
                    </div>
                    
                    <div class="form-group">
                        <label>Catégories</label>
                        <div class="categories" id="categories">
                            <label><input type="radio" name="category" value="art" <?= $product['category'] === 'art' ? 'checked' : '' ?> required> ART</label>
                            <label><input type="radio" name="category" value="book" <?= $product['category'] === 'book' ? 'checked' : '' ?>> LIVRE</label>
                            <label><input type="radio" name="category" value="exhibition" <?= $product['category'] === 'exhibition' ? 'checked' : '' ?>> EXPOSITION</label>
                            <label><input type="radio" name="category" value="painting" <?= $product['category'] === 'painting' ? 'checked' : '' ?>> PEINTURE</label>
                            <label><input type="radio" name="category" value="sculpture" <?= $product['category'] === 'sculpture' ? 'checked' : '' ?>> SCULPTURE</label>
                        </div>
                    </div>
                    
                    <div class="form-group price-inputs">
                        <div>
                            <label for="regular-price">Prix normal (€)</label>
                            <input name="regular-price" type="number" step="0.01" id="regular-price" value="<?= htmlspecialchars($product['prix_normale']) ?>" required min="0.01">
                        </div>
                        <div>
                            <label for="sale-price">Prix de vente (€)</label>
                            <input name="sale-price" type="number" step="0.01" id="sale-price" value="<?= htmlspecialchars($product['prix_promotion']) ?>" min="0">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="product-description">Description du produit</label>
                        <textarea id="product-description" name="product-description" rows="5" required minlength="20"><?= htmlspecialchars($product['description']) ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="product-image">Image du produit</label>
                        <div class="image-preview">
                            <?php if (!empty($product['image'])): ?>
                                <img
                               src= "/ilyes/server/mvc/view/back/images/<?= htmlspecialchars($product['image']) ?>"
                                  alt="<?= htmlspecialchars($product['titre']) ?>" style="max-width: 200px; max-height: 200px;">
                            <?php else: ?>
                                <p>No image available</p>
                            <?php endif; ?>
                        </div>
                        <input name="product-image" type="file" id="product-image" accept="image/*" style="display: none;">
                        <button type="button" class="btn btn-secondary" onclick="document.getElementById('product-image').click()">Changer l'image</button>
                        <input type="hidden" name="existing-image" value="<?= htmlspecialchars($product['image'] ?? '') ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="stock-quantity">Quantité en stock</label>
                        <input type="number" name="stock-quantity" id="stock-quantity" value="<?= htmlspecialchars($product['quantite']) ?>" required min="0">
                    </div>
                    
                    <div class="actions">
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='boutique.php'">Annuler</button>
                        <button type="submit" class="btn">Mettre à jour</button>
                    </div>
                </form>
            </div>
            
            <!-- Your sidebar content remains the same -->
        </div>
    </main>

    <script>
        // Preview uploaded image
        document.getElementById('product-image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const preview = document.querySelector('.image-preview');
                    preview.innerHTML = `<img src="${event.target.result}" style="max-width: 200px; max-height: 200px;">`;
                };
                reader.readAsDataURL(file);
            }
        });

        // Form validation
        document.getElementById('update-form').addEventListener('submit', function(e) {
            const productTitle = document.getElementById('product-title').value.trim();
            const regularPrice = parseFloat(document.getElementById('regular-price').value);
            const salePrice = parseFloat(document.getElementById('sale-price').value);
            const category = document.querySelector('input[name="category"]:checked');
            const stockQuantity = parseInt(document.getElementById('stock-quantity').value);
            const productDescription = document.getElementById('product-description').value.trim();
            
            // Clear previous errors
            document.querySelectorAll('.error-message').forEach(el => el.remove());
            document.querySelectorAll('.error-highlight').forEach(el => el.classList.remove('error-highlight'));
            
            let isValid = true;
            
            // Validate product title
            if (productTitle.length < 5) {
                showError('product-title', 'Le titre doit contenir au moins 5 caractères');
                isValid = false;
            }
            
            // Validate prices
            if (regularPrice <= 0) {
                showError('regular-price', 'Le prix normal doit être supérieur à 0');
                isValid = false;
            }
            
            if (salePrice > 0 && salePrice >= regularPrice) {
                showError('sale-price', 'Le prix en promotion doit être inférieur au prix normal');
                isValid = false;
            }
            
            // Validate category
            if (!category) {
                showError('categories', 'Veuillez sélectionner une catégorie');
                isValid = false;
            }
            
            // Validate stock quantity
            if (stockQuantity < 0) {
                showError('stock-quantity', 'La quantité doit être un nombre positif');
                isValid = false;
            }
            
            // Validate description
            if (productDescription.length < 20) {
                showError('product-description', 'La description doit contenir au moins 20 caractères');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
        
        function showError(fieldId, message) {
            const field = document.getElementById(fieldId) || document.getElementById(fieldId + '-container');
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            errorDiv.style.color = 'red';
            errorDiv.style.fontSize = '12px';
            errorDiv.style.marginTop = '5px';
            errorDiv.textContent = message;
            
            if (field) {
                field.classList.add('error-highlight');
                field.parentNode.appendChild(errorDiv);
            }
        }
    </script>
</body>
</html>