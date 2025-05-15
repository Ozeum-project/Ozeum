<?php
session_start();
include 'C:\xampp\htdocs\ozeum\ilyes\server\mvc\controller\cartController.php';
include 'C:\xampp\htdocs\ozeum\ilyes\server\mvc\controller\productController.php'; 
//include 'C:\xampp\htdocs\ozeum\ilyes\server\mvc\model\cartModel.php';

if (isset($_POST['add_to_cart']) && isset($_SESSION['user_email'])) {
    $user_email = $_SESSION['user_email'];
    $product_id = intval($_POST['product_id']);
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    $cartItem = new CartItem(0, $user_email, $product_id, $quantity);
    $cartController = new cartController();
    $cartController->addToCart($cartItem);

    // Optional: Redirect to avoid form resubmission
    header("Location: shop.php?added=1");
    exit();
}  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ozeum - Product Detail</title>
    <link rel="stylesheet" href="../stylefe.css">
    <link rel="stylesheet" href="productDetails.css">
    <script src="project.js" ></script>
</head>
<body> 
    
    <div class="top-bar">
        <div>LE MUSÉE EST OUVERT AUJOURD'HUI DE 10H À 17H</div>
        <div>34ÈME AVE, Technopole, Ghazela</div>
    </div>

    <header class="header">
        <div class="logo">ozeum</div>
        <nav class="nav">
            <a href="../../ayoub/inscription.html">ACCUEIL</a>
            <a href="../../aadel/frontoffice.html">BLOG</a>
            <a href="\ozeum\ilyes\server\mvc\view\front\shop.php">BOUTIQUE</a>
            <a href="../../nour khadouma/formajou.html">AVIS</a>
            <a href="../../ghofrane/accceuil.html">GALLERIE</a>
            <a href="#">PROFILE</a>
        </nav>
    </header>
<!-- <div class="hero">
        <div class="hero-content">
            <h1>Cart</h1>

        </div>
    </div> -->
 

    <div class="container">
        <!-- <div class="notification" >
            <span>0 elements in  your cart.</span>
            <button class="view-cart-btn" onclick="window.location.href='cart.html'">VIEW CART</button>
        </div> -->

        <div class="product-section">
            <?php
// Include the controller at the top of the file
//include 'C:\xampp\htdocs\ozeum\ilyes\server\mvc\controller\productController.php';

// Get the product ID from URL parameter
$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Initialize controller and get product
$productController = new ProductController();
$product = $productController->getProductById($productId);

// Default product if not found
if (!$product) {
    $product = [
        'id' => 0,
        'titre' => 'Product Not Found',
        'description' => 'The requested product could not be found.',
        'image' => 'path/to/default/image.jpg',
        'prix_normale' => '0.00',
        'prix_promotion' => '0.00',
        'category' => 'Unknown'
    ];
}
?>
            <!-- Product content -->
            <div class="product-image-container">
                <span class="sale-badge">-20%</span>
                <div class="zoom-container">
                    <img src="../back/images/<?= htmlspecialchars($product["image"]) ?>" 
                 alt="<?= htmlspecialchars($product['titre']) ?>"  class="product-image">
                    <div class="zoom-lens"></div>
                </div>
            </div>

            <div class="product-info">
                <h1><?= htmlspecialchars($product['titre']) ?></h1>
                <div class="price">
                    <span class="original-price"><?= htmlspecialchars($product['prix_normale']) ?></span>
                    <span class="sale-price">$<?= htmlspecialchars($product['prix_promotion']) ?></span>
                </div>
                <p class="description">
                    <?= nl2br(htmlspecialchars($product['description'])) ?>
                 </p>
                <!-- <div class="purchase-section">
                    <input type="number" value="3" min="1" class="quantity">
                    <button class="buy-now-btn" onclick="montrer()">BUY NOW</button>
                </div> -->
                <div class="product-meta">
                    <p>Category: <a href="#"><?= htmlspecialchars($product['category']) ?></a></p>
                    <!-- <p>Tags: <a href="#">Art</a>, <a href="#">Book</a>, <a href="#">Exhibition</a></p> --> 
                     
                    <p>id : <?= htmlspecialchars($product['id']) ?></p>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="footer-grid">
            <div class="footer-column">
                <h3>VISITEZ-NOUS</h3>
                <div class="contact-info">
                    <p>34ème Ave, Technopole</p>
                    <p> Ghazela</p>
                    <p>Tunis</p>
                    <p>Téléphone : (555) 123-4567</p>
                    <p>Email : info@ozeum.com</p>
                </div>
            </div>

            <div class="footer-column">
                <h3>HEURES D'OUVERTURE</h3>
                <ul class="schedule-list">
                    <li><span>Lundi</span> <span>10H - 17H</span></li>
                    <li><span>Mardi</span> <span>10H - 17H</span></li>
                    <li><span>Mercredi</span> <span>10H - 17H</span></li>
                    <li><span>Jeudi</span> <span>10H - 20H</span></li>
                    <li><span>Vendredi</span> <span>10H - 20H</span></li>
                    <li><span>Week-end</span> <span>10H - 18H</span></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>LIENS RAPIDES</h3>
                <ul class="footer-links">
                    <li><a href="#">Expositions Actuelles</a></li>
                    <li><a href="../ayoub/index.html">Événements à Venir</a></li>
                    <li><a href="../ilyas/front/shop.html">Boutique du Musée</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>NEWSLETTER</h3>
                <p style="margin-bottom: 20px; color: rgba(255, 255, 255, 0.6); font-size: 15px;">Abonnez-vous à notre newsletter pour recevoir des mises à jour sur les nouvelles expositions, événements et plus encore.</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Votre adresse email" class="newsletter-input">
                    <button type="submit" class="newsletter-button">S'abonner</button>
                </form>
            </div>
        </div>

        <div class="footer-bottom">
            <div>&copy; 2025 Ozeum. Tous droits réservés.</div>
            <div class="social-links">
                <a href="#">Facebook</a>
                <a href="#">Twitter</a>
                <a href="#">Instagram</a>
                <a href="#">YouTube</a>
            </div>
        </div>
    </footer>

    
</body>
</html>