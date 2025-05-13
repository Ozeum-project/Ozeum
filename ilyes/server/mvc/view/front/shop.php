<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ozeum - Art Gallery Shop</title>
    <link rel="stylesheet" href="../stylefe.css">
    <link rel="stylesheet" href="shop.css">
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
    <main class="main-content">
        <section class="product-section">
            <div class="product-controls">
                <div class="view-options">
                    <?php
                    include 'C:\xampp\htdocs\ilyes\server\mvc\controller\productController.php';
                    $productController = new ProductController();
                    
                    // Get filter parameters
                    $searchTerm = isset($_GET['search']) ? $_GET['search'] : null;
                    $category = isset($_GET['category']) ? $_GET['category'] : null;
                    $minPrice = isset($_GET['min_price']) ? (float)$_GET['min_price'] : null;
                    $maxPrice = isset($_GET['max_price']) ? (float)$_GET['max_price'] : null;
                    
                    // Get price range
                    $priceRange = $productController->getPriceRange();
                    $dbMinPrice = $priceRange['min_price'] ?? 10;
                    $dbMaxPrice = $priceRange['max_price'] ?? 35;
                    
                    // Initialize min/max price if not specified
                    if ($minPrice === null) $minPrice = $dbMinPrice;
                    if ($maxPrice === null) $maxPrice = $dbMaxPrice;
                    
                    // Get products based on filters
                    $products = $productController->getProducts($searchTerm, $category, $minPrice, $maxPrice);
                    
                    // Count total products
                    $totalProducts = count($products);
                    
                    // Set the display text based on whether we're filtering or not
                    if ($searchTerm || $category || ($minPrice != $dbMinPrice) || ($maxPrice != $dbMaxPrice)) {
                        echo "<span>Showing {$totalProducts} filtered result(s)</span>";
                        echo "<a href='shop.php' class='clear-search'>Clear all filters</a>";
                    } else {
                        echo "<span>Showing 1-{$totalProducts} of {$totalProducts} results</span>";
                    }
                    ?>
                </div>
                <!-- <select class="sort-dropdown">
                    <option>Sort by latest</option>
                </select> -->
            </div>
            <div class="product-grid">
            <?php
            // Display products - the same template for both filtered results and all products
            foreach ($products as $productData) { 
            ?>
                <div class="product-card">
                    <span class="discount-badge">-20%</span>
                    <div class="product-image-container">
                        <img  src="../back/images/<?= htmlspecialchars($productData["image"]) ?>" alt="<?= $productData['titre'] ?>" class="product-image">
                        <div class="product-buttons">
                            <!-- <button class="view-details-btn" onclick="window.location.href='product-details.php?id=<?= $productData['id'] ?>'">VIEW DETAILS</button> -->
                            <button class="add-to-cart-btn">ADD TO CART</button>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-categories"><?= $productData['category'] ?></div>
                        <a class="product-title" onclick="window.location.href='productDetails.php?id=<?= $productData['id'] ?>'" ><?= $productData['titre'] ?></a>
                        <div class="product-price">
                            <span class="original-price"><?= $productData['prix_normale'] ?>$</span>
                            <span><?= $productData['prix_promotion'] ?>$</span>
                        </div>
                    </div>
                </div>
            <?php } ?>
            
            <?php if (count($products) == 0): ?>
                <div class="no-results">
                    <h3>No products found</h3>
                    <?php if ($searchTerm || $category || ($minPrice != $dbMinPrice) || ($maxPrice != $dbMaxPrice)): ?>
                        <p>No products match your current filters.</p>
                        <p><a href="shop.php">Clear all filters</a></p>
                    <?php else: ?>
                        <p>There are no products in the catalog yet.</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            </div>
        </section>
        
        <aside class="sidebar">
            <div class="sidebar-section">
                <h3 class="sidebar-title">Cart</h3>
                <div class="cart-item">
                    <img src="https://i.pinimg.com/originals/58/88/da/5888da528749981d1bc5616a4aaf46c1.jpg" alt="Boy with a Book">
                    <div>
                        <p>Boy with a Book</p>
                        <p>2 × $12.00</p>
                    </div>
                </div> 
                <div class="cart-item">
                    <img src="https://i.pinimg.com/originals/58/88/da/5888da528749981d1bc5616a4aaf46c1.jpg" alt="Boy with a Book">
                    <div>
                        <p>Boy with a Book</p>
                        <p>2 × $12.00</p>
                    </div>
                </div> 
                <button type="submit" class="filter-btn" onclick="window.location.href='cart.php'" >VIEW CART</button> 
                </div>
                <div class="sidebar-section">
                    <h3 class="sidebar-title">Search</h3>
                    <form action="shop.php" method="GET" id="search-form">
                        <input type="search" name="search" placeholder="Search for product..." 
                        class="search-input" value="<?= htmlspecialchars($searchTerm ?? '') ?>">
                        <?php if ($category): ?>
                            <input type="hidden" name="category" value="<?= htmlspecialchars($category) ?>">
                        <?php endif; ?>
                        <input type="hidden" name="min_price" value="<?= htmlspecialchars($minPrice) ?>">
                        <input type="hidden" name="max_price" value="<?= htmlspecialchars($maxPrice) ?>">
                    </form>
                </div>
                <div class="sidebar-section">
                    <h3 class="sidebar-title">Categories</h3>
                    <?php
                        // Get category counts
                        $categoryCounts = $productController->getCategoryCounts();
                    ?>
                    <ul class="categories-list">
                        <?php foreach ($categoryCounts as $categoryName => $count): ?>
                            <li class="category-item">
                                <a href="shop.php?category=<?= urlencode($categoryName) ?><?= $searchTerm ? '&search=' . urlencode($searchTerm) : '' ?><?= $minPrice !== null ? '&min_price=' . $minPrice : '' ?><?= $maxPrice !== null ? '&max_price=' . $maxPrice : '' ?>" 
                                   class="<?= $category === $categoryName ? 'active-category' : '' ?>">
                                    <?= htmlspecialchars($categoryName) ?> 
                                    <span class="category-count"><?= $count ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                        <?php if ($category): ?>
                            <li class="category-item">
                                <a href="shop.php?<?= $searchTerm ? 'search=' . urlencode($searchTerm) . '&' : '' ?><?= $minPrice !== null ? 'min_price=' . $minPrice . '&' : '' ?><?= $maxPrice !== null ? 'max_price=' . $maxPrice : '' ?>" 
                                class="clear-category">Clear category filter</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    
                <div class="sidebar-section">
                    <h3 class="sidebar-title">Filter by Price</h3>
                    <form action="shop.php" method="GET" id="price-filter-form">
                        <?php if ($searchTerm): ?>
                            <input type="hidden" name="search" value="<?= htmlspecialchars($searchTerm) ?>">
                        <?php endif; ?>
                        <?php if ($category): ?>
                            <input type="hidden" name="category" value="<?= htmlspecialchars($category) ?>">
                        <?php endif; ?>
                        
                        <div class="price-labels">
                            <span>$<span id="min-price-display"><?= $minPrice ?></span></span>
                            <span>$<span id="max-price-display"><?= $maxPrice ?></span></span>
                        </div>
                        <input type="range" 
                               id="price-slider-min" 
                               name="min_price" 
                               min="<?= $dbMinPrice ?>" 
                               max="<?= $dbMaxPrice ?>" 
                               value="<?= $minPrice ?>" 
                               class="price-range"
                               oninput="document.getElementById('min-price-display').textContent = this.value">
                        <input type="range" 
                               id="price-slider-max" 
                               name="max_price" 
                               min="<?= $dbMinPrice ?>" 
                               max="<?= $dbMaxPrice ?>" 
                               value="<?= $maxPrice ?>" 
                               class="price-range"
                               oninput="document.getElementById('max-price-display').textContent = this.value">
                        <button type="submit" class="filter-btn">FILTER</button>
                    </form>
                </div>
                
            
        </aside>
    </main>
    
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
    
    <script>
    // JavaScript to ensure min price is not greater than max price and vice versa
    document.addEventListener('DOMContentLoaded', function() {
        const minSlider = document.getElementById('price-slider-min');
        const maxSlider = document.getElementById('price-slider-max');
        
        minSlider.addEventListener('input', function() {
            if (parseInt(minSlider.value) > parseInt(maxSlider.value)) {
                maxSlider.value = minSlider.value;
                document.getElementById('max-price-display').textContent = maxSlider.value;
            }
        });
        
        maxSlider.addEventListener('input', function() {
            if (parseInt(maxSlider.value) < parseInt(minSlider.value)) {
                minSlider.value = maxSlider.value;
                document.getElementById('min-price-display').textContent = minSlider.value;
            }
        });
        
        // Auto-submit search form when typing
        const searchInput = document.querySelector('.search-input');
        if (searchInput) {
            searchInput.addEventListener('keyup', function(event) {
                if (event.key === 'Enter') {
                    document.getElementById('search-form').submit();
                }
            });
        }
    });
    </script>
</body>
</html>