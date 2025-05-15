<?php
include 'C:\xampp\htdocs\ozeum\config.php';
include 'C:\xampp\htdocs\ozeum\ghofrane\model\artoffer.php';
class ArtController
{
    public function listoffer1()
    {
        $sql = "SELECT * FROM art";
        $db = config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e){
            die('error : '.$e->getMessage());
        }
    }
    function addOffer(Art $Art)
    {   var_dump($Art);
        $sql = "INSERT INTO art (code,nom,date,categorie,disponibilite,id,image) 
        VALUES (:code, :nom,:datec,:cat, :dispo, :id, :img)";
        $db = config::getConnexion();
        try {
            
            $query = $db->prepare($sql);
            $query->execute([
                'code' => $Art->getCode(),
                'nom' => $Art->getNom(),
                'datec' => $Art->getDate()->format('Y-m-d'), 
                'cat' =>$Art->getCategory(),
                'dispo' => $Art->getDisponibilite(),
                'id' => $Art->getIda(), 
                'img' => $Art->getImg()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    function deleteOffer($id)
    {
    
        // Step 1: Fetch the image path associated with the artwork from the database
        $sql = "SELECT image FROM art WHERE code = ?";
        //$pdo = config::getConnexion();
        $db = config::getConnexion();
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);

            // Fetch the image path
            $artwork = $stmt->fetch();
            $imagePath = $artwork['image'];

            // Step 2: Get the image path starting from the 14th character
            $imageFilePath = 'E:/xampp/htdocs/2eme esprit/web-project/ghofrane/' . substr($imagePath, 5);  // Get substring from character 14 onward

            // Check if the file exists before deleting it
            if (file_exists($imageFilePath)) {
                unlink($imageFilePath);  // Delete the image
                echo "Image deleted successfully.";
            } else {
                echo "Image not found.";
                echo $imageFilePath;
            }
        

        $sql = "DELETE FROM art WHERE code = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function updateOffer($offer, $id)
{
    //var_dump($offer);
    try {
        $db = config::getConnexion();

        $query = $db->prepare(
            "UPDATE art SET 
                code = :code , 
                nom = :nom  ,
                date = :datec ,
                categorie = :cat, 
                disponibilite = :dispo, 
                id = :idd, 
                image = :img
            WHERE code = :oldcode"
        );

        $query->execute([
                'code' => $offer->getCode(),
                'nom' => $offer->getNom(),
                'datec' => $offer->getDate()->format('Y-m-d'), 
                'cat' =>$offer->getCategory(),
                'dispo' => $offer->getDisponibilite(),
                'idd' => $offer->getIda(), 
                'img' => $offer->getImg(),
                'oldcode'=> $id
        ]);
        echo "OLD CODE: ".$id." <br>";
        echo "NEW CODE: " . $offer->getCode() . "<br>";


        echo $query->rowCount() . $id ." records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); 
    }
}


    function showOffer($id)
    {
        $sql = "SELECT * from art where code = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);

            $offer = $query->fetch();
            return $offer;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function getAllArtistIds()
    {
        $sql = "SELECT id FROM artiste";
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
    public function getAllArtworkCodes()
    {
        $sql = "SELECT code FROM art";
        $db = config::getConnexion();
        try {
            $result = $db->query($sql);
            $codes = [];
            foreach ($result as $row) {
                $codes[] = $row['code'];
            }
            return $codes;
        } catch (Exception $e) {
            die('error: ' . $e->getMessage());
        }
    }


}



?>