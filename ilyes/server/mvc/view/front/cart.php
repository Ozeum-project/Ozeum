<?php
session_start();
include 'C:\xampp\htdocs\ozeum\ilyes\server\mvc\controller\cartController.php';
//get all !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
$cartItems = [];
if (isset($_SESSION['user_email'])) {
    $cartController = new cartController();
    $cartItems = $cartController->getCartWithProducts($_SESSION['user_email']);
} 


 // update cart !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id'])) {
    $cart_id = intval($_POST['cart_id']);
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    if (isset($_POST['increment'])) {
        $quantity++;
    } elseif (isset($_POST['decrement']) && $quantity > 1) {
        $quantity--;
    }

    // Call updateCart function
    $cartController->updateCart($cart_id, $quantity);

    // Refresh to avoid resubmission
    header("Location: cart.php");
    exit();
} 


//applyCoupon !!!!!!!!!!!!!!!!!!!!!!!!!!!!!! 
$couponError = '';
$appliedPromotion = 0;

if (isset($_POST['apply_coupon'])) {
    $enteredCode = trim($_POST['coupon_code']);
    $db = config::getConnexion();
    $stmt = $db->prepare("SELECT * FROM coupons WHERE coupon = :code");
    $stmt->bindValue(':code', $enteredCode, PDO::PARAM_STR);
    $stmt->execute();
    $coupon = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($coupon) {
        $appliedPromotion = intval($coupon['promotion']);
    } else {
        $couponError = "Ce code coupon n'existe pas.";
    }
} 

/// total !!!!!!!!!!!!!!!!!!!!!!!!!!!!
$cartSubtotal = 0;
foreach ($cartItems as $item) {
    $cartSubtotal += $item['prix_promotion'] * $item['quantity'];
}
$discount = 0;
if ($appliedPromotion > 0) {
    $discount = ($cartSubtotal * $appliedPromotion) / 100;
}
$shipping = 25.00;
$cartTotal = $cartSubtotal - $discount + $shipping;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../stylefe.css">
    <link rel="stylesheet" href="cart.css"> 
    <script src="project.js"></script>
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
            <a href="../../view/front/shop.php">BOUTIQUE</a>
            <a href="../../nour khadouma/formajou.html">AVIS</a>
            <a href="../../ghofrane/accceuil.html">GALLERIE</a>
            <a href="#">PROFILE</a>
        </nav>
    </header>
     <!-- <div class="hero">
        <div class="hero-content">
            <h1>Shop</h1>
        </div>
    </div> -->
    <div class="cart-container">
        <div class="cart-status">Cart updated.</div>

        <table class="cart-table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($cartItems)): ?>
            <?php foreach ($cartItems as $item): ?>
                <tr>
                    <td>
                        <div class="product-info">
                            <button class="remove-item" onclick="window.location.href='removeFromCart.php?id=<?= $item['cart_id'] ?>'">×</button>
                            <img src="../back/images/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['titre']) ?>" class="product-image">
                            <span><?= htmlspecialchars($item['titre']) ?></span>
                        </div>
                    </td>
                    <td>$<?= number_format($item['prix_promotion'], 2) ?></td>
                    <td>
                        <form method="post" action="cart.php" class="update-quantity-form" style="display:flex; align-items:center; gap:4px;">
                            <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
                            <button type="submit" name="decrement" class="arrow-btn" style="border:none;background:none;font-size:18px;cursor:pointer;">&#8595;</button>
                            <input type="text" name="quantity" value="<?= $item['quantity'] ?>" class="quantity-input" style="width:32px;text-align:center;" readonly>
                            <button type="submit" name="increment" class="arrow-btn" style="border:none;background:none;font-size:18px;cursor:pointer;">&#8593;</button>
                        </form>
                    </td>
                    <td>$<?= number_format($item['prix_promotion'] * $item['quantity'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
            <!-- Cart totals rows -->
            <tr>
                <td colspan="3" style="text-align:left;"><strong>Subtotal</strong></td>
                <td><strong>$<?= number_format($cartSubtotal, 2) ?></strong></td>
            </tr> 
            <?php if ($appliedPromotion > 0): ?>
            <tr>
               <td colspan="3" style="text-align:left; color:#27ae60;"><strong>Coupon (-<?= $appliedPromotion ?>%)</strong></td>
                <td style="color:#27ae60;">- $<?= number_format($discount, 2) ?></td>
         </tr>
    <?php endif; ?>
            <tr>
                <td colspan="3" style="text-align:righleftt;">Shipping</td>
                <td>$<?= number_format($shipping, 2) ?> <span style="font-size:12px;color:#888;">(Flat rate)</span></td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:left;"><strong>Total</strong></td>
                <td><strong>$<?= number_format($cartTotal, 2) ?></strong></td>
            </tr> 
          
            <tr>
                <td colspan="4" style="text-align:right;">
                    <button class="checkout-btn">PROCEED TO CHECKOUT</button>
                </td>
            </tr>
        <?php else: ?>
            <tr>
                <td colspan="4" style="text-align:center; color:#888;">Votre panier est vide.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table> 
<!-- coupon !!!!!! -->

         <form method="post" style="display:flex; gap:8px; align-items:center;">
    <input type="text" name="coupon_code" placeholder="Coupon code" class="coupon-input" required>
    <button type="submit" name="apply_coupon" class="btn btn-primary">APPLIQUER</button>
         </form>
<?php if (!empty($couponError)): ?>
    <div style="color: #e74c3c; margin-top: 8px;"><?= htmlspecialchars($couponError) ?></div>
<?php endif; ?>

        <div class="cart-totals">
    <!-- <table class="totals-table">
        <tr>
            <th colspan="2">Cart totals</th>
        </tr>
        <tr>
            <td>Subtotal</td>
            <td>$<?= number_format($cartSubtotal, 2) ?></td>
        </tr>
        <tr>
            <td>Shipping</td>
            <td>
                <div class="shipping-info">
                    <div>
                        <div>Flat rate: $<?= number_format($shipping, 2) ?></div>
                        <div>Shipping to Tunisia</div>
                    </div>
                    <a href="#" class="change-address">Change address</a>
                </div>
            </td>
        </tr>
        <tr>
            <td>Total</td>
            <td>$<?= number_format($cartTotal, 2) ?></td>
        </tr>
    </table> -->
    <!-- <button class="checkout-btn">PROCEED TO CHECKOUT</button> -->
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