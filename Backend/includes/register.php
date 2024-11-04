<?php
require_once '../config/db.php';
require_once '../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (registerUser($conn, $email, $password)) {
        echo "Registration successful!";
    } else {
        echo "Registration failed!";
    }
}
