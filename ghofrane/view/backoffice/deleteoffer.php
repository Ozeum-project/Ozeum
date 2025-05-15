<?php
include 'C:\xampp\htdocs\ozeum\ghofrane\controller\galleriecontroller.php';
$travelOfferC = new ArtController();
$travelOfferC->deleteOffer($_GET["id"]);
header('Location:form.php');
exit();
?>