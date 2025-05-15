<?php
include 'C:\xampp\htdocs\ozeum\config.php';
include 'C:\xampp\htdocs\ozeum\saadbouznif\mvc\model\usersModel.php'; 
class UserController {
    public function addUser(User $user): bool
    {
        $sql = "INSERT INTO users 
                (name, lastName, email, password, image, adresse, telephone)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $db = config::getConnexion();
        
        try {
            $query = $db->prepare($sql);
            $success = $query->execute([
                 htmlspecialchars($user->getName()),
                 htmlspecialchars($user->getLastName()),
                filter_var($user->getEmail(), FILTER_SANITIZE_EMAIL),
                 $user->getPassword(), // Now contains pre-hashed password
                 $user->getImage(),
                htmlspecialchars($user->getAdresse()) ,
                 htmlspecialchars($user->getTelephone()),
                
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
        $sql = "SELECT  name, lastName, email, password, image, adresse ,telephone,role
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
           // error_log("Database error in getUserByEmail: " . $e->getMessage());
            throw new Exception("Error accessing user data". $e->getMessage());
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


    public function deleteUserByEmail($email) {
        $db = config::getConnexion();
        $sql = "DELETE FROM users WHERE email = :email";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
    }
    public function deleteUser($email) {
        $sql = "DELETE FROM users WHERE email = :email";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }  
   

    public function updateUser(User $user, string $email) {
        try {
            $db = config::getConnexion();
    
            $query = $db->prepare("
                UPDATE users SET 
                    name = :name,
                    lastName = :lastName,
                    password = :password,
                    image = :image,
                    adresse = :adresse,
                    telephone = :telephone
                WHERE email = :email
            ");
    
            $query->execute([
                'name' => $user->getName(),
                'lastName' => $user->getLastName(),
                'password' => $user->getPassword(),
                'image' => $user->getImage(),
                'adresse' => $user->getAdresse(),
                'telephone' => $user->getTelephone(),
                'email' => $email
            ]);
    
            return $query->rowCount();
        } catch (PDOException $e) {
            echo "Error while updating user: " . $e->getMessage();
            return false;
        }
    }
}
?>