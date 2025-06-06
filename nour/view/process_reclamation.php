<?php
include 'C:\xampp\htdocs\ozeum\nour\controller\reclamationcontroller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validate form inputs
        $errors = [];
        
        if (empty($_POST['title'])) {
            $errors[] = "Title is required";
        } elseif (strlen($_POST['title']) < 5) {
            $errors[] = "Title must be at least 5 characters long";
        }
        
        if (empty($_POST['email'])) {
            $errors[] = "Email is required";
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }
        
        if (empty($_POST['subject'])) {
            $errors[] = "Subject is required";
        } elseif (strlen($_POST['subject']) < 10) {
            $errors[] = "Subject must be at least 10 characters long";
        }
        
        if (empty($_POST['status'])) {
            $errors[] = "Status is required";
        }
        
        if (!empty($errors)) {
            header("Location: addreclamation.php?error=" . urlencode(implode(", ", $errors)));
            exit();
        }
        
        // Create a new Reclamation object without ID (let DB auto-increment)
        $reclamation = new Reclamation(
            null, // ID will be auto-generated by database
            $_POST['title'],
            $_POST['name'] ?? '',
            $_POST['email'],
            $_POST['subject'],
            $_POST['status']
        );
        
        // Create ReclamationController instance
        $controller = new ReclamationController();
        
        // Add the reclamation
        $controller->addReclamation($reclamation);
        
        // Redirect with success message
        header("Location: addreclamation.php?success=1");
        exit();
        
    } catch (Exception $e) {
        header("Location: addreclamation.php?error=" . urlencode("An error occurred: " . $e->getMessage()));
        exit();
    }
} else {
    header("Location: addreclamation.php");
    exit();
}