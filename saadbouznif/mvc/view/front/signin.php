<?php 

session_start(); 

include 'C:\xampp\htdocs\ozeum\saadbouznif\mvc\controller\usersController.php';
// ...existing code...
$error = "";
$userController = new UserController();


// Check for registration success message
$registrationSuccess = isset($_SESSION['registration_success']) ? $_SESSION['registration_success'] : false;
unset($_SESSION['registration_success']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['password'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    try {
        $user = $userController->getUserByEmail($email);
        
        if ($user) {
            // Secure password verification using password_verify
            if (password_verify($password, $user['password'])) {
                // Successful login 
                
                //die("DEBUG: Should redirect to admin dashboard. Role is: " . $user['role']);
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_lastName'] = $user['lastName'];
                $_SESSION['user_role'] = $user['role'];
                
                // Regenerate session ID to prevent session fixation
                session_regenerate_id(true);
                
                if ($user['role'] === 'admin') {
                    header("Location: /ozeum/ilyes/server/mvc/view/back/boutique.php");
                    error_log("Attempting admin redirect");
                } else { 
                    error_log("Attempting user redirect");
                    header("Location: /ozeum/pro/view/front/index.php"); // normal user
                }
exit();
            } else {
                $error = "Email ou mot de passe incorrect.";
            }
        } else {
            $error = "Email ou mot de passe incorrect.";
        }
    } catch (Exception $e) {
        // error_log("Login error: " . $e->getMessage());
        // $error = "Une erreur s'est produite lors de la connexion."; 
        $error = "Erreur technique: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Ozeum</title>
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
        
        .success-message {
            color: #2ecc71;
            background-color: #e8fdf1;
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            border-left: 4px solid #2ecc71;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .error-message svg,
        .success-message svg {
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
            font-weight: 600;
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
            font-weight: 500;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
            box-sizing: border-box;
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
            font-weight: 500;
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
            font-weight: 500;
        }

        .form-container a:hover {
            color: #b18952;
            text-decoration: underline;
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

        /* Responsive adjustments */
        @media (max-width: 480px) {
            .form-container {
                padding: 30px 20px;
                margin: 0 15px;
            }
            
            .form-title {
                font-size: 24px;
            }
        }
    </style>
</head>
<body> 

    <div class="form-container">
        <?php if ($registrationSuccess): ?>
            <div class="success-message">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>
                <span>Inscription réussie! Vous pouvez maintenant vous connecter.</span>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($error)): ?>
            <div class="error-message">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                <span><?php echo htmlspecialchars($error); ?></span>
            </div>
        <?php endif; ?>

        <h2 class="form-title">Connexion</h2>
        
        <form id="signin-form" method="POST" action="signin.php">
            <div class="form-group">
                <label for="email" class="form-label">Adresse Email</label>
                <input type="email" id="email" name="email" class="form-input" 
                       placeholder="Entrez votre adresse email" required
                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Mot de Passe</label>
                <input type="password" id="password" name="password" class="form-input" 
                       placeholder="Entrez votre mot de passe" required>
            </div>
            <button type="submit" class="submit-button">Se Connecter</button>
            <p>
                Vous n'avez pas de compte ? <a href="register.php">Inscrivez-vous ici</a>.
            </p>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const signinForm = document.getElementById('signin-form');
            
            // Enhanced client-side validation
            signinForm.addEventListener('submit', function(e) {
                const email = signinForm.querySelector('#email');
                const password = signinForm.querySelector('#password');
                
                if (!email.value.trim()) {
                    e.preventDefault();
                    alert('Veuillez entrer votre adresse email.');
                    email.focus();
                    return;
                }
                
                if (!password.value.trim()) {
                    e.preventDefault();
                    alert('Veuillez entrer votre mot de passe.');
                    password.focus();
                    return;
                }
                
                // Basic email format validation
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email.value)) {
                    e.preventDefault();
                    alert('Veuillez entrer une adresse email valide.');
                    email.focus();
                }
            });
        });
    </script>
</body>
</html>