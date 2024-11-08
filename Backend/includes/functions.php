<?php
require_once '../config/db.php';

// Sign-in User
function signInUser($email, $password) {
    $conn = Database::getInstance()->getConnection();
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    } else {
        return false;
    }
}

// Register User
function registerUser($email, $password) {
    $conn = Database::getInstance()->getConnection();
    $query = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));
    return $stmt->execute();
}
?>