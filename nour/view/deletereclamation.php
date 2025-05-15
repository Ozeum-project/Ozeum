<?php
include 'C:\xampp\htdocs\ozeum\nour\controller\reclamationcontroller.php';
$reclamationC = new ReclamationController();
$reclamationC->deleteReclamation($_GET["id"]);
header('Location:reclamations.php');
