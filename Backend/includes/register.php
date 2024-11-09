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
        $success = registerUser($email, $password);
        if ($success) {
            // Automatically log in the user after successful registration
            $user = signInUser($email, $password);
            if ($user) {
                $message = "Registration and login successful! Welcome, " . htmlspecialchars($user['email']);
            } else {
                $message = "Registration successful, but login failed!";
            }
        } else {
            $message = "Registration failed!";
        }
    } catch (Exception $e) {
        $message = "An error occurred: " . $e->getMessage();
    }
    header("Location: ../src/testLogIn.php?message=" . urlencode($message));
    exit();
}
?>