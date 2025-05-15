<?php
session_start();
include 'C:\xampp\htdocs\ozeum\saadbouznif\mvc\controller\usersController.php';
$error = "";
$userController = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validate inputs
        if (empty($_POST["name"]) || empty($_POST["lastName"]) || 
            empty($_POST["email"]) || empty($_POST["password"])) {
            throw new Exception("Tous les champs sont requis.");
        }

        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Adresse email invalide.");
        }

        // Hash the password before creating the user object
        $hashedPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
        
        // Create user object with hashed password
        $user = new User(
            $_POST["name"],
            $_POST["lastName"],
            $_POST["email"],
            $hashedPassword,
            "default.jpg",
            "",
            "", // telephone
           
        );

        // Try to add user
        if ($userController->addUser($user)) {
            $_SESSION['registration_success'] = true;
            header("Location: signin.php");
            exit();
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - Ozeum</title>
    <link rel="stylesheet" href="test.css">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .error-message {
            color: #e74c3c;
            background-color: #fde8e8;
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            border-left: 4px solid #e74c3c;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .error-message svg {
            flex-shrink: 0;
        }
        .form-container {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
            animation: fadeIn 0.5s ease-in-out;
        }

        .form-title {
            font-size: 28px;
            font-weight: 300;
            margin-bottom: 20px;
            color: #222;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #444;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #eee;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #c4a164;
            box-shadow: 0 0 0 3px rgba(196, 161, 100, 0.1);
        }

        .submit-button {
            background: #c4a164;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 10px;
        }

        .submit-button:hover {
            background: #b18952;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(196, 161, 100, 0.2);
        }

        .form-container p {
            margin-top: 15px;
            font-size: 14px;
            color: #666;
        }

        .form-container a {
            color: #c4a164;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .form-container a:hover {
            color: #b18952;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
<div class="form-container">
        <?php if (!empty($error)): ?>
            <div class="error-message">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                <span><?php echo htmlspecialchars($error); ?></span>
            </div>
        <?php endif; ?>

        <h2 class="form-title">Inscription</h2>
        
        <form id="register-form" method="POST" action="register.php">
        <form id="register-form" action="register.php" method="POST">
    <input type="hidden" name="user-id" value="<?php echo uniqid(); ?>">
    
    <div class="form-group">
        <label for="name" class="form-label">Nom</label>
        <input type="text" id="name" name="name" class="form-input" 
               placeholder="Entrez votre nom" required>
    </div>
    
    <div class="form-group">
        <label for="lastName" class="form-label">Prénom</label>
        <input type="text" id="lastName" name="lastName" class="form-input" 
               placeholder="Entrez votre prénom" required>
    </div>
    
    <div class="form-group">
        <label for="email" class="form-label">Adresse Email</label>
        <input type="email" id="email" name="email" class="form-input" 
               placeholder="Entrez votre adresse email" required>
    </div>
    
    <div class="form-group">
        <label for="password" class="form-label">Mot de Passe</label>
        <input type="password" id="password" name="password" class="form-input" 
               placeholder="Entrez votre mot de passe" required>
    </div> 
    <div class="form-group">
    <label for="confirm_password" class="form-label">Confirmez le mot de passe</label>
    <input type="password" id="confirm_password" name="confirm_password" class="form-input" 
           placeholder="Confirmez votre mot de passe" required>
</div>
    
    <button type="submit" class="submit-button">S'inscrire</button>
    
    <p>
        Vous avez déjà un compte ? <a href="signin.php">Connectez-vous ici</a>.
    </p>
</form>


    </div>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.getElementById('register-form');
    if (!registerForm) return;

    registerForm.addEventListener('submit', function(e) {
        const name = registerForm.querySelector('#name');
        const lastName = registerForm.querySelector('#lastName');
        const email = registerForm.querySelector('#email');
        const password = registerForm.querySelector('#password');
        const confirmPassword = registerForm.querySelector('#confirm_password');

        // Name validation
        if (name.value.trim().length < 2) {
            e.preventDefault();
            alert('Le nom doit contenir au moins 2 caractères.');
            name.focus();
            return;
        }

        // Last name validation
        if (lastName.value.trim().length < 2) {
            e.preventDefault();
            alert('Le prénom doit contenir au moins 2 caractères.');
            lastName.focus();
            return;
        }

        // Email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email.value)) {
            e.preventDefault();
            alert('Veuillez entrer une adresse email valide.');
            email.focus();
            return;
        }

        // Password length
        if (password.value.length < 8) {
            e.preventDefault();
            alert('Le mot de passe doit contenir au moins 8 caractères.');
            password.focus();
            return;
        }

        // Password complexity (at least one letter and one number)
        const regex = /^(?=.*[A-Za-z])(?=.*\d).+$/;
        if (!regex.test(password.value)) {
            e.preventDefault();
            alert('Le mot de passe doit contenir au moins une lettre et un chiffre.');
            password.focus();
            return;
        }

        // Password confirmation
        if (password.value !== confirmPassword.value) {
            e.preventDefault();
            alert('Les mots de passe ne correspondent pas.');
            confirmPassword.focus();
            return;
        }
    });
});
</script>
</body>
</html>