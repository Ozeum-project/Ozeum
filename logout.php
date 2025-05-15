<?php
session_start();
session_unset();
session_destroy();
header("Location: /ozeum/pro/view/front/index.php"); // Redirect to homepage or login page
exit();
?>