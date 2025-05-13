<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="C:\xampp\htdocs\ilyes\stylefe.css">
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
            <a href="../../ilyas/front/shop.html">BOUTIQUE</a>
            <a href="../../nour khadouma/formajou.html">AVIS</a>
            <a href="../../ghofrane/accceuil.html">GALLERIE</a>
            <a href="#">PROFILE</a>
        </nav>
    </header>
     <div class="hero">
        <div class="hero-content">
            <h1>Shop</h1>
        </div>
    </div>
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
                <tr>
                    <td>
                        <div class="product-info">
                            <button class="remove-item">×</button>
                            <img src="https://th.bing.com/th/id/OIP.P5tEClpAS8mRDclhB-MypQHaF5?rs=1&pid=ImgDetMain" alt="Boy with a Book" class="product-image">
                            <span>Boy with a Book</span>
                        </div>
                    </td>
                    <td>$12.00</td>
                    <td>
                        <div class="quantity-selector">
                            <input type="text" value="2" class="quantity-input">
                            <div class="quantity-arrows">
                                <span class="arrowUp" onclick="increment()">▲</span>
                                <span class="arrowDown" onclick="decrement()">▼</span>
                            </div>
                        </div>
                    </td>
                    <td>$24.00</td>
                </tr>
                <tr>
                    <td>
                        <div class="product-info">
                            <button class="remove-item">×</button>
                            <img src="https://th.bing.com/th/id/OIP.P5tEClpAS8mRDclhB-MypQHaF5?rs=1&pid=ImgDetMain" alt="Boy with a Book" class="product-image">
                            <span>Boy with a Book</span>
                        </div>
                    </td>
                    <td>$12.00</td>
                    <td>
                        <div class="quantity-selector">
                            <input type="text" value="2" class="quantity-input">
                            <div class="quantity-arrows">
                                <span class="arrow">▲</span>
                                <span class="arrow">▼</span>
                            </div>
                        </div>
                    </td>
                    <td>$24.00</td>
                </tr>
                <tr>
                    <td>
                        <div class="product-info">
                            <button class="remove-item">×</button>
                            <img src="https://th.bing.com/th/id/OIP.P5tEClpAS8mRDclhB-MypQHaF5?rs=1&pid=ImgDetMain" alt="Boy with a Book" class="product-image">
                            <span>Boy with a Book</span>
                        </div>
                    </td>
                    <td>$12.00</td>
                    <td>
                        <div class="quantity-selector">
                            <input type="text" value="2" class="quantity-input">
                            <div class="quantity-arrows">
                                <span class="arrow">▲</span>
                                <span class="arrow">▼</span>
                            </div>
                        </div>
                    </td>
                    <td>$24.00</td>
                </tr>
                <!-- Additional cart items would go here -->
            </tbody>
        </table>

        <div class="coupon-section">
            <input type="text" placeholder="Coupon code" class="coupon-input">
            <button class="btn btn-primary">APPLY COUPON</button>
            <button class="btn btn-secondary">UPDATE CART</button>
        </div>

        <div class="cart-totals">
            <table class="totals-table">
                <tr>
                    <th colspan="2">Cart totals</th>
                </tr>
                <tr>
                    <td>Subtotal</td>
                    <td>$96.00</td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>
                        <div class="shipping-info">
                            <div>
                                <div>Flat rate: $25.00</div>
                                <div>Shipping to Tunisia</div>
                            </div>
                            <a href="#" class="change-address">Change address</a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>$121.00</td>
                </tr>
            </table>

            <button class="checkout-btn">PROCEED TO CHECKOUT</button>
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