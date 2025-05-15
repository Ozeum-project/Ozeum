<?php
include '../../model/eventmodel.php';
include 'C:\xampp\htdocs\ozeum\config.php';

class EventController
{
    public function listEvents()
    {
        $sql = "SELECT * FROM upcommingevents";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function addEvent($event)
    {
        $sql = "INSERT INTO upcommingevents 
                (titre, date_debut, heure_debut, date_fin, heure_fin, lieu, categorie, nbmax, description, img) 
                VALUES 
                (:titre, :date_debut, :heure_debut, :date_fin, :heure_fin, :lieu, :categorie, :nbmax, :description, :img)";
        
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'titre' => $event->getTitre(),
                'date_debut' => $event->getDateDebut()->format('Y-m-d'),
                'heure_debut' => $event->getHeureDebut()->format('h:i A'),
                'date_fin' => $event->getDateFin()->format('Y-m-d'),
                'heure_fin' => $event->getHeureFin()->format('h:i A'),
                'lieu' => $event->getLieu(),
                'categorie' => $event->getCategorie(),
                'nbmax' => $event->getNbMax(),
                'description' => $event->getDescription(),
                'img' => $event->getImage()
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function updateEvent($event, $id)
    {
        $sql = "UPDATE upcommingevents SET 
                titre = :titre, 
                date_debut = :date_debut, 
                heure_debut = :heure_debut, 
                date_fin = :date_fin, 
                heure_fin = :heure_fin, 
                lieu = :lieu, 
                categorie = :categorie, 
                nbmax = :nbmax, 
                description = :description, 
                img = :img 
                WHERE idd = :id";
        
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'titre' => $event->getTitre(),
                'date_debut' => $event->getDateDebut()->format('Y-m-d'),
                'heure_debut' => $event->getHeureDebut()->format('h:i A'),
                'date_fin' => $event->getDateFin()->format('Y-m-d'),
                'heure_fin' => $event->getHeureFin()->format('h:i A'),
                'lieu' => $event->getLieu(),
                'categorie' => $event->getCategorie(),
                'nbmax' => $event->getNbMax(),
                'description' => $event->getDescription(),
                'img' => $event->getImage()
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function deleteEvent($id)
    {
        // First get the image path
        $sql = "SELECT img FROM upcommingevents WHERE idd = ?";
        $db = config::getConnexion();
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        
        $event = $stmt->fetch();
        if ($event && !empty($event['img'])) {
            $imagePath = __DIR__ . 'A:\web\xamp\htdocs\pro\images' . basename($event['img']);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Then delete the event
        $sql = "DELETE FROM upcommingevents WHERE idd = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
}
?>