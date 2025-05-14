
<?php
include 'C:\xampp\htdocs\ozeum\saadbouznif\mvc\controller\usersController.php';
$depController = new UserController();

if (isset($_GET["email"])) {
    $depController->deleteUserByEmail($_GET["email"]);
}
header('Location: users.php');
exit();
?>