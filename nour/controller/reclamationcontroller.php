<?php
include 'C:\xampp\htdocs\ozeum\config.php';
include 'C:\xampp\htdocs\ozeum\nour\model\reclamation.php';
class ReclamationController
{
    /**
     * List all reclamations
     * @return array List of reclamations
     */
    public function listReclamations()
    {
        $sql = "SELECT * FROM reclamation";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('error : ' . $e->getMessage());
        }
    }

    function deleteReclamation($id)
    {
   
        // Delete the blog post from database
        $sql = "DELETE FROM reclamation WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    /**
     * Add a new reclamation
     * @param Reclamation $reclamation The reclamation to add
     */
    function addReclamation(Reclamation $reclamation)
{
    $sql = "INSERT INTO reclamation (title, name, email, subject, status) 
            VALUES (:title, :name, :email, :subject, :status)";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'title' => $reclamation->getTitle(),
            'name' => $reclamation->getName(),
            'email' => $reclamation->getEmail(),
            'subject' => $reclamation->getSubject(),
            'status' => $reclamation->getStatus()
        ]);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

    /**
     * Update a reclamation
     * @param Reclamation $reclamation The updated reclamation data
     * @param int $id The ID of the reclamation to update
     */
    function updateReclamation(Reclamation $reclamation, $id)
    {
        try {
            $db = config::getConnexion();

            $query = $db->prepare(
                "UPDATE reclamation SET 
                    title = :title,
                    name = :name,
                    email = :email,
                    subject = :subject, 
                    status = :status
                WHERE id = :oldid"
            );

            $query->execute([
                'title' => $reclamation->getTitle(),
                'name' => $reclamation->getName(),
                'email' => $reclamation->getEmail(),
                'subject' => $reclamation->getSubject(),
                'status' => $reclamation->getStatus(),
                'oldid' => $id
            ]);

            echo $query->rowCount() . " record(s) UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); 
        }
    }

    /**
     * Get a reclamation by ID
     * @param int $id The ID of the reclamation to get
     * @return array The reclamation data
     */
    function getReclamation($id)
    {
        $sql = "SELECT * FROM reclamation WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);

            $reclamation = $query->fetch();
            return $reclamation;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    /**
     * Get all reclamation IDs
     * @return array List of reclamation IDs
     */
    public function getAllReclamationIds()
    {
        $sql = "SELECT id FROM reclamation";
        $db = config::getConnexion();
        try {
            $result = $db->query($sql);
            $ids = [];
            foreach ($result as $row) {
                $ids[] = $row['id'];
            }
            return $ids;
        } catch (Exception $e) {
            die('error: ' . $e->getMessage());
        }
    }

    /**
     * Get reclamations by status
     * @param string $status The status to filter by
     * @return array List of reclamations with the specified status
     */
    public function getReclamationsByStatus($status)
    {
        $sql = "SELECT * FROM reclamation WHERE status = :status";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['status' => $status]);
            
            return $query->fetchAll();
        } catch (Exception $e) {
            die('error: ' . $e->getMessage());
        }
    }

    /**
     * Get reclamations by email
     * @param string $email The email to filter by
     * @return array List of reclamations from the specified email
     */
    public function getReclamationsByEmail($email)
    {
        $sql = "SELECT * FROM reclamation WHERE email = :email";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['email' => $email]);
            
            return $query->fetchAll();
        } catch (Exception $e) {
            die('error: ' . $e->getMessage());
        }
    }
}
?>