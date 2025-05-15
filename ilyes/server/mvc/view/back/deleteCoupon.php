
<?php
include_once 'C:\xampp\htdocs\ozeum\config.php';

if (isset($_GET['id'])) {
    $db = config::getConnexion();
    $sql = "DELETE FROM coupons WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', intval($_GET['id']), PDO::PARAM_INT);
    $stmt->execute();
}

// Redirect back to boutique.php
header("Location: boutique.php");
exit();
?>