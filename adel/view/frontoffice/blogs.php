    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ozeum - Blog</title>
        <link rel="stylesheet" href="blogsstyles.css">
        <script>
            // Function to display blog details in a modal
            function showBlogDetails(blog) {
                const modal = document.getElementById('blogDetailsModal');
                const content = document.getElementById('blogDetailsContent');
                
                // Create the content for the modal
                let detailsHTML = `
                    <div class="blog-detail-header">
                        <h2>${blog.titre}</h2>
                        <div class="blog-meta">
                            <span class="blog-category">${blog.categorie}</span>
                            <span class="blog-author">Par: ${blog.auteur}</span>
                            <span class="blog-date">Publié le: ${blog.date_publication}</span>
                        </div>
                    </div>
                    <div class="blog-thumbnail">
                        <img src="${blog.thumbnail}" alt="${blog.titre}">
                    </div>
                    <div class="blog-content-full">
                        ${blog.contenu}
                    </div>
                `;
                
                content.innerHTML = detailsHTML;
                modal.style.display = 'flex';
            }
            
            // Function to close the modal
            function closeBlogModal() {
                document.getElementById('blogDetailsModal').style.display = 'none';
            }
        </script>
    </head>
    <body>
        <!-- Header with navigation -->
        <header>
            <div class="logo">ozeum</div>
            <nav class="main-nav">
            <nav class="nav">
            <a href="\ozeum\pro\view\front\index.php">ACCUEIL</a>
            <a href="\ozeum\adel\view\frontoffice\blogs.php">BLOG</a>
            <a href="\ozeum\ilyes\server\mvc\view\front\shop.php">BOUTIQUE</a>
            <a href="\ozeum\nour\view\addreclamation.php">AVIS</a>
            <a href="\ozeum\ghofrane\view\frontoffice\acceuil.php">GALLERIE</a>
          <a href="/ozeum/saadbouznif/mvc/view/front/signin.php" class="nav-item">LOGIN</a>
        </nav>
                <script>
                    // Ensure modal closes when clicking outside the modal content
                    document.addEventListener('DOMContentLoaded', function() {
                        const modal = document.getElementById('blogDetailsModal');
                        if (modal) {
                            modal.addEventListener('click', function(event) {
                                if (event.target === modal) {
                                    closeBlogModal();
                                }
                            });
                        }
                    });
                </script>
            </nav>
        </header>
        
        <!-- Main blog section -->
        <section class="blog-section">
            <div class="blog-header">
                <h1 class="blog-title">Blog</h1>
                
                </a>
            </div>
            
            <div class="blog-divider"></div>
            
            <p class="blog-description">
                Chez Ozeum, nous aspirons à promouvoir, développer et présenter le travail d'artistes phares, aussi que ceux qui sont encore émergents et en milieu de carrière exceptionnels. 
            </p>
            
            <!-- Blog posts grid -->
            <div class="blog-grid">
                <?php
                    include 'C:\xampp\htdocs\ozeum\adel\controller\blogcontroller.php';
                    
                    $blogController = new BlogController();
                    $blogs = $blogController->getPublishedPosts();
                    
                    foreach ($blogs as $blog) {
                        echo "
                        <div class='blog-item'>
                            <div class='blog-image'>
                                <img src='{$blog['thumbnail']}' alt='{$blog['titre']}'>
                                <a class='read-more' onclick='showBlogDetails(".json_encode($blog).")'>Lire plus</a>
                            </div>
                            <div class='blog-content'>
                                <h2>{$blog['titre']}</h2>
                                <div class='blog-category'>{$blog['categorie']}</div>
                            </div>
                        </div>";
                    }
                ?>
            </div>
        </section>
        
        <!-- Blog Details Modal -->
        <div id="blogDetailsModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); align-items: center; justify-content: center; onclick="closeBlogModal()">
            <div class="blog-modal-container" style="width: 800px; max-height: 80%; overflow-y: auto; background-color: white; padding: 30px; border-radius: 8px;">
                <div class="modal-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h2 class="modal-title">Article du Blog</h2>
                    <button onclick="closeBlogModal()" class="close-button" style="padding: 10px 20px; background-color: #d8b162; color: white; border: none; border-radius: 4px; cursor: pointer;">Fermer</button>
                </div>
                <div id="blogDetailsContent">
                    <!-- Blog details will be dynamically populated -->
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <footer>
            <div class="footer-content">
                <!-- Logo and address -->
                <div class="footer-column">
                    <div class="footer-logo">ozeum</div>
                    <div class="footer-address">
                        123 Art Avenue<br>
                        Museum District<br>
                        Ghazela, Ariana<br>
                        Tel: +216 95 093 313<br>
                        Email: info@ozeum.com
                    </div>
                </div>
                
                <!-- Links column -->
                <div class="footer-column">
                    <h3>Links</h3>
                    <ul class="footer-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Exhibitions</a></li>
                        <li><a href="#">Collections</a></li>
                    </ul>
                </div>
                
                <!-- More info column -->
                <div class="footer-column">
                    <h3>More Info</h3>
                    <ul class="footer-links">
                        <li><a href="#">Visiting Hours</a></li>
                        <li><a href="#">Membership</a></li>
                        <li><a href="#">Education</a></li>
                    </ul>
                </div>
                
                <!-- Socials column -->
                <div class="footer-column">
                    <h3>Socials</h3>
                    <ul class="footer-links">
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Facebook</a></li>
                    </ul>
                </div>
            </div>
        </footer>
        
        <!-- Scroll to top button -->
        <a href="#" class="scroll-top">↑</a>
    </body>
    </html>