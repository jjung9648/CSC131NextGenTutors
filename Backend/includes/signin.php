<?php
require_once '../config/db.php';
require_once '../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = signInUser($conn, $email, $password);
    if ($user) {
        echo "Sign-in successful! Welcome, " . htmlspecialchars($user['email']);
    } else {
        echo "Sign-in failed!";
    }
}
