<?php
session_start();
include 'C:\xampp\htdocs\ozeum\ilyes\server\mvc\controller\cartController.php';

if (isset($_GET['id'])) {
    $cartController = new cartController();
    $cartController->removeFromCart(intval($_GET['id']));
}
header("Location: cart.php");
exit();
?>