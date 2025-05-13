<?php
include '../../controller/productController.php';
$depController = new productController();
$depController->deleteProduct($_GET["id"]);
header('Location:boutique.php');
?>