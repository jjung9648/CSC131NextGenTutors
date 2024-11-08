<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/db.php';
require_once '../includes/functions.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $user = signInUser($email, $password);
        if ($user) {
            $message = "Sign-in successful! Welcome, " . htmlspecialchars($user['email']);
        } else {
            $message = "Sign-in failed!";
        }
    } catch (Exception $e) {
        $message = "An error occurred: " . $e->getMessage();
    }
}

// Output the message
if ($message) {
    echo $message;
}
?>