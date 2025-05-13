<?php
include '../../controller/productController.php';
$error = "";
$productController = new ProductController();

if (
    isset($_POST["product-id"], $_POST["product-title"], $_POST["product-description"], $_POST["regular-price"], $_POST["sale-price"], $_POST["stock-quantity"], $_POST["category"]) &&
    isset($_FILES["product-image"])
) {
    if (
        !empty($_POST["product-id"]) && !empty($_POST["product-title"]) && !empty($_POST["product-description"]) &&
        !empty($_POST["regular-price"]) && !empty($_POST["sale-price"]) &&
        !empty($_POST["stock-quantity"]) && !empty($_POST["category"])
    ) {
        $image = "default.jpg"; // par défaut

        // Gestion de l'image
        $upload_dir = "C:/xampp/htdocs/ozeum/ilyes/server/mvc/view/back/images/";
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_extension = strtolower(pathinfo($_FILES["product-image"]["name"], PATHINFO_EXTENSION));
        $unique_name = uniqid('product_', true) . '.' . $file_extension;
        $target_file = $upload_dir . $unique_name;

        $check = getimagesize($_FILES["product-image"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["product-image"]["tmp_name"], $target_file)) {
                $image = $unique_name; // image enregistrée
            } else {
                $error = "Erreur lors du téléchargement de l'image.";
            }
        } else {
            $error = "Le fichier n'est pas une image valide.";
        }

        if (!$error) {
            $product = new Product(
                intval($_POST["product-id"]),
                $_POST["product-title"],
                $_POST["product-description"],
                floatval($_POST["regular-price"]),
                floatval($_POST["sale-price"]),
                intval($_POST["stock-quantity"]),
                $image,
                $_POST["category"]
            );

            $productController->addProduct($product);
            header("Location: boutique.php");
            exit();
        }
    } else {
        $error = "Tous les champs sont requis.";
    }
} else {
    $error = "Formulaire invalide.";
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ozeum - Add Product</title>
       <link rel="stylesheet" href="addProduct.css">

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
                <a href="../../nour khadouma/feedback.html" class="nav-link">
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
    <main class="main-content">
        <!-- Header -->
        <header class="dashboard-header">
            <h1 class="page-title">Boutique</h1>
            <div class="user-menu">
                <!-- <img src="istockphoto-1127367070-612x612.jpg" alt="Admin"> -->
                <span>Admin</span>
            </div>
        </header>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-title">Produits totaux</div>
                <div class="stat-value">24</div>
                <div class="stat-change">+5% ce mois</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Produits actifs</div>
                <div class="stat-value">20</div>
                <div class="stat-change">+2% ce mois</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Rupture de stock</div>
                <div class="stat-value">2</div>
                <div class="stat-change">-1% ce mois</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">En promotion</div>
                <div class="stat-value">8</div>
                <div class="stat-change">+3% ce mois</div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="dashboard-card">
            <div class="card-header">
                <h2 class="card-title">Ajouter un nouveau produit</h2>
            </div>
            
            <form id="add-product-form"method="POST" enctype="multipart/form-data" >
                <div class="form-grid"> 
                     <div class="form-group full-width">
                        <label class="form-label" for="product-id">ID du produit</label>
                        <input type="number" id="product-id" name="product-id" class="form-input" 
                               placeholder="Entrez l'ID du produit">
                    </div>
                    <div class="form-group full-width">
                        <label class="form-label" for="product-title">Titre du produit</label>
                        <input type="text" id="product-title" name="product-title" class="form-input" 
                               minlength="5" placeholder="Entrez le titre du produit">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="regular-price">Prix normal (€)</label>
                        <input type="number" id="regular-price" name="regular-price" class="form-input" 
                               min="0" step="0.01" placeholder="15.00">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="sale-price">Prix en promotion (€)</label>
                        <input type="number" id="sale-price" name="sale-price" class="form-input" 
                               min="0" step="0.01" placeholder="12.00">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="category">Catégorie</label>
                        <select id="category" name="category" class="form-input" >
                            <option value="">Sélectionnez une catégorie</option>
                            <option value="art">Art</option>
                            <option value="book">Livre</option>
                            <option value="exhibition">Exposition</option>
                            <option value="painting">Peinture</option>
                            <option value="sculpture">Sculpture</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="stock-quantity">Quantité en stock</label>
                        <input type="number" id="stock-quantity" name="stock-quantity" class="form-input" 
                               min="0" placeholder="Entrez la quantité">
                    </div>
                    
                    <div class="form-group full-width">
                        <label class="form-label" for="product-description">Description du produit</label>
                        <textarea id="product-description" name="product-description" class="form-input" 
                                  minlength="20" placeholder="Entrez la description du produit"></textarea>
                    </div>
                    
                    <div class="form-group full-width">
                        <label class="form-label">Image du produit</label>
                        <input type="file" accept="image/*" style="display: none;" id="product-image" name="product-image">
                        <div class="image-preview" id="image-preview" onclick="document.getElementById('product-image').click()">
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
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='boutique.php'">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter le produit</button>
                </div>
            </form>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('add-product-form');
    
    form.addEventListener('submit', function(event) {
      event.preventDefault();
        
        const productTitle = document.getElementById('product-title').value.trim();
        const regularPrice = document.getElementById('regular-price').value;
        const salePrice = document.getElementById('sale-price').value;
        const category = document.getElementById('category').value;
        const stockQuantity = document.getElementById('stock-quantity').value;
        const productDescription = document.getElementById('product-description').value.trim();
        const productImage = document.getElementById('product-image').files;
        
        // Remove any existing error messages
        const oldErrors = document.querySelectorAll('.error-message');
        oldErrors.forEach(function(error) {
            error.remove();
        });
        
        // Check if all  fields are filled
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
        if (category === '') {
            showError('category', 'Veuillez sélectionner une catégorie.');
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
        
        // Check product image
        if (productImage.length === 0) {
            showError('image-preview', 'Veuillez sélectionner une image pour le produit.');
            isValid = false;
        }
        
        // If everything is valid, submit the form
        if (isValid) {
            form.submit();
            
            // Reset the form after successful submission
            form.reset();
            
            // Reset image preview
            const preview = document.getElementById('image-preview');
            preview.style.backgroundImage = '';
            preview.innerHTML = `
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                    <polyline points="21 15 16 10 5 21"></polyline>
                </svg>
                <span style="margin-left: 10px;">Cliquez ou glissez une image ici</span>
            `;
            
            // Here you would typically send the form data to a backend
            // form.submit();
        }
    });
    
    // Function to show error messages
    function showError(inputId, message) {
        const input = document.getElementById(inputId);
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.style.color = 'red';
        errorDiv.style.fontSize = '12px';
        errorDiv.style.marginTop = '5px';
        errorDiv.textContent = message;
        
        // Add the error message after the input
        input.parentNode.insertBefore(errorDiv, input.nextSibling);
    }
    
    // Image preview functionality
    document.getElementById('product-image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (!file) return;
        
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('image-preview');
            preview.innerHTML = '';
            preview.style.backgroundImage = `url(${e.target.result})`;
            preview.style.backgroundSize = 'cover';
            preview.style.backgroundPosition = 'center';
        }
        reader.readAsDataURL(file);
    });
});
    </script>
</body>
</html>