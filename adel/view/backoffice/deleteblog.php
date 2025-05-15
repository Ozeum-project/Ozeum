<?php
include 'C:\xampp\htdocs\ozeum\adel\controller\blogcontroller.php';
$blogC = new BlogController();
$blogC->deletepost($_GET["id"]);
header('Location:form.php');
