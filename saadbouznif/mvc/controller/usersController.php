<?php
include 'C:\xampp\htdocs\ozeum\saadbouznif\mvc\config.php';
include 'C:\xampp\htdocs\ozeum\saadbouznif\mvc\model\usersModel.php'; 
class UserController {
    public function addUser(User $user): bool
    {
        $sql = "INSERT INTO users 
                (name, lastName, email, password, image, adresse)
                VALUES (:name, :lastName, :email, :password, :image, :adresse)";
        
        $db = config::getConnexion();
        
        try {
            $query = $db->prepare($sql);
            $success = $query->execute([
                'name' => htmlspecialchars($user->getName()),
                'lastName' => htmlspecialchars($user->getLastName()),
                'email' => filter_var($user->getEmail(), FILTER_SANITIZE_EMAIL),
                'password' => $user->getPassword(), // Now contains pre-hashed password
                'image' => $user->getImage(),
                'adresse' => htmlspecialchars($user->getAdresse())
            ]);
    
            // Verify insertion was successful
            if ($success && $query->rowCount() > 0) {
                return true;
            }
            return false;
            
        } catch (PDOException $e) {
            // Log specific error for debugging
            error_log("Database Error [addUser]: " . $e->getMessage());
            
            // Check for duplicate email error (MySQL error code 1062)
            if ($e->errorInfo[1] == 1062) {
                throw new Exception("Cette adresse email est déjà utilisée.");
            }
            
            throw new Exception("Une erreur est survenue lors de l'inscription.");
        }
    } 

    public function getUserByEmail(string $email): ?array 
    {
        $sql = "SELECT id, name, lastName, email, password, image, adresse 
                FROM users 
                WHERE email = :email 
                LIMIT 1";
        
        $db = config::getConnexion();
        
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user ?: null;
            
        } catch (PDOException $e) {
            error_log("Database error in getUserByEmail: " . $e->getMessage());
            throw new PDOException("Error accessing user data");
        }
    }
    public function listUsers() {
        $sql = "SELECT * FROM users";
        $db = config::getConnexion();
        
        try {
            $query = $db->query($sql);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    } 

    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }  
   

    public function updateUser(User $user, int $id) {
        try {
            $db = config::getConnexion();

            $query = $db->prepare("
                UPDATE users SET 
                    name = :name,
                    lastName = :lastName,
                    email = :email,
                    password = :password,
                    image = :image,
                    adresse = :adresse
                WHERE id = :id
            ");

            $query->execute([
                'name' => $user->getName(),
                'lastName' => $user->getLastName(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(), // Make sure to hash this before passing to controller
                'image' => $user->getImage(),
                'adresse' => $user->getAdresse(),
                'id' => $id
            ]);

            return $query->rowCount(); // Returns number of affected rows
        } catch (PDOException $e) {
            echo "Error while updating user: " . $e->getMessage();
            return false;
        }
    }
}
?>