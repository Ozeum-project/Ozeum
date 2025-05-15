<?php
include 'C:\xampp\htdocs\ozeum\nour\controller\reclamationcontroller.php';

$error = "";

$reclamation = null;
// create an instance of the controller
$reclamationController = new ReclamationController();

if (
    isset($_POST["id"], $_POST["name"], $_POST["title"], $_POST["email"], $_POST["subject"])
) {
    if (
        !empty($_POST["id"]) &&
        !empty($_POST["name"]) &&  
        !empty($_POST["title"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["subject"])
    ) {
        
        $reclamation_id = (int)time();
        $status = "En attente";

        // Only create reclamation post if no errors occurred
        if (!$error) {
            $reclamation = new reclamation(
                $reclamation_id,
                $_POST['name'],
                $_POST['title'],
                $_POST['email'],
                $_POST['subject'],
                $status
            );
            
            $reclamationController->addReclamation($reclamation);
            header('Location: addreclamation.php');
            exit;
        }
    } else {
        $error = "Missing information";
    }
    
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ozeum - Reclamation</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    .top-bar {
        background: #000;
        color: #fff;
        padding: 8px 40px;
        display: flex;
        justify-content: space-between;
        font-size: 14px;
    }

    .main-header {
        background: rgba(0, 0, 0, 0.9);
        padding: 20px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .logo {
        color: #fff;
        font-size: 32px;
        text-decoration: none;
        font-weight: bold;
    }

    .main-nav {
        display: flex;
        gap: 30px;
    }

    .main-nav a {
        color: #fff;
        text-decoration: none;
        text-transform: uppercase;
        font-size: 14px;
    }

    .hero {
        height: 300px;
        background-image: url(../images/hero1.jpg);
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        position: relative;
    }

    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
    }

    .hero-content {
        position: relative;
        z-index: 1;
        text-align: center;
    }

    .hero h1 {
        font-size: 48px;
        margin-bottom: 20px;
    }

    .breadcrumb {
        color: #fff;
        margin-top: 10px;
    }

    .breadcrumb a {
        color: #fff;
        text-decoration: none;
    }

    .container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /* Center and style the form */
    #add-reclamation-form {
        background: #fff;
        padding: 40px 32px;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08), 0 1.5px 6px rgba(0,0,0,0.04);
        max-width: 420px;
        width: 100%;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    /* Form Styling */
    .form-group {
        margin-bottom: 22px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #1a1a1a;
        letter-spacing: 0.5px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border-radius: 6px;
        border: 1px solid #ddd;
        font-size: 16px;
        transition: border 0.3s;
        background: #fafbfc;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #C4A853;
        outline: none;
        background: #fff;
    }

    .form-group textarea {
        min-height: 120px;
        resize: vertical;
    }

    .submit-btn {
        padding: 12px 0;
        border-radius: 25px;
        border: none;
        background: linear-gradient(90deg, #C4A853 0%, #1a1a1a 100%);
        color: white;
        font-size: 17px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
        letter-spacing: 1px;
        box-shadow: 0 2px 8px rgba(196,168,83,0.08);
    }

    .submit-btn:hover {
        background: linear-gradient(90deg, #1a1a1a 0%, #C4A853 100%);
        color: #fff;
    }

    .error-message {
        background-color: #ffebee;
        color: #c62828;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 4px;
        border-left: 4px solid #c62828;
        max-width: 420px;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }

    /* Footer styling */
    .footer {
        background: #15181B;
        color: #fff;
        padding: 80px 40px 20px;
    }

    .footer-content {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr;
        gap: 40px;
    }

    .footer-logo {
        color: #C4A853;
        font-size: 32px;
        margin-bottom: 20px;
    }

    .footer-info {
        color: #9A9A9A;
        font-size: 16px;
        line-height: 1.6;
    }

    .footer h3 {
        color: white;
        font-size: 20px;
        margin-bottom: 20px;
    }

    .footer-links {
        list-style: none;
    }

    .footer-links li {
        margin-bottom: 15px;
    }

    .footer-links a {
        color: #9A9A9A;
        text-decoration: none;
        transition: color 0.3s;
    }

    .footer-links a:hover {
        color: #C4A853;
    }

    .copyright {
        margin-top: 60px;
        padding-top: 20px;
        border-top: 1px solid rgba(255,255,255,0.1);
        text-align: right;
        color: #9A9A9A;
        font-size: 14px;
    }

    /* Reclamation title styling */
    .reclamation-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .reclamation-title {
        font-size: 32px;
        color: #1a1a1a;
    }

    .divider {
        border: none;
        height: 1px;
        background-color: #ddd;
        margin: 30px 0;
    }

    @media (max-width: 600px) {
        .container {
            padding: 0 8px;
        }
        #add-reclamation-form {
            padding: 24px 8px;
            max-width: 98vw;
        }
        .footer-content {
            grid-template-columns: 1fr;
            gap: 24px;
        }
    }
    .nav {
    display: flex;
    gap: 32px;  
}

.nav a {
    color: rgba(255, 255, 255, 0.85);
    text-decoration: none;
    font-size: 13px;  
    letter-spacing: 0.8px;  
    transition: all 0.3s ease;
    position: relative;
    padding: 3px 0; 
}

.nav a:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 1px;
    background: #c4a164;
    transition: width 0.3s ease;
}

.nav a:hover {
    color: #fff;
}

.nav a:hover:after {
    width: 100%;
}
    </style>
    <script src="addreclamation.js" defer></script>
</head>
<body>
    <div class="top-bar">
        <div>Opening Hours: 9:00 AM - 6:00 PM</div>
        <div>Contact: +216 95 093 313</div>
    </div>

    <header class="main-header">
        <a href="index.html" class="logo">ozeum</a>
        <nav class="nav">
            <a href="\ozeum\pro\view\front\index.php">ACCUEIL</a>
            <a href="\ozeum\adel\view\frontoffice\blogs.php">BLOG</a>
            <a href="\ozeum\ilyes\server\mvc\view\front\shop.php">BOUTIQUE</a>
            <a href="\ozeum\nour\view\addreclamation.php">AVIS</a>
            <a href="\ozeum\ghofrane\view\frontoffice\acceuil.php">GALLERIE</a>
          <a href="/ozeum/saadbouznif/mvc/view/front/signin.php" class="nav-item">LOGIN</a>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>Laissez-vous entendre!</h1>
            <div class="breadcrumb">
                <a href="index.html">Acceuil</a> / Réclamations
            </div>
        </div>
    </section>

    <main>
        <div class="container">            
            <?php if ($error): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form id="add-reclamation-form" method="POST" action="addreclamation.php" >
                <input type="hidden" name="id" value="<?php echo time(); ?>">
                
                <div class="form-group">
                    <label for="name">Donner votre nom:</label>
                    <input type="text" id="name" name="name" placeholder="Saisissez votre nom">
                </div>
                
                <div class="form-group">
                    <label for="title"> Titre de la réclamation </label>
                    <input type="text" id="title" name="title" placeholder="Saisissez le titre de la réclamation">
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Saisissez votre email">
                </div>
                
                <div class="form-group">
                    <label for="subject">Sujet de la réclamation </label>
                    <textarea id="subject" name="subject" placeholder="Décrire votre réclamation"></textarea>
                </div>
                
                <button type="submit" class="submit-btn">Soumettre</button>
            </form>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div>
                <div class="footer-logo">ozeum</div>
                <p class="footer-info">
                    123 Art Avenue<br>
                    Museum District<br>
                    Ghazela, Ariana<br>
                    Tel: +216 95 093 313<br>
                    Email: info@ozeum.com
                </p>
            </div>
            
            <div>
                <h3>Links</h3>
                <ul class="footer-links">
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="exhibitions.html">Exhibitions</a></li>
                    <li><a href="collections.html">Collections</a></li>
                </ul>
            </div>
            
            <div>
                <h3>More Info</h3>
                <ul class="footer-links">
                    <li><a href="visiting-hours.html">Visiting Hours</a></li>
                    <li><a href="membership.html">Membership</a></li>
                    <li><a href="education.html">Education</a></li>
                </ul>
            </div>
            
            <div>
                <h3>Socials</h3>
                <ul class="footer-links">
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Facebook</a></li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            &copy; 2025 Ozeum. All rights reserved.
        </div>
    </footer>
</body>
</html>