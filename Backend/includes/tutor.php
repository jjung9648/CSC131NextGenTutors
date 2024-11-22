<?php
require_once 'user.php';

class Tutor implements User {
    public function signIn($email, $password) {
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT * FROM tutors WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $tutor = $stmt->fetch();

        if ($tutor && password_verify($password, $tutor['password'])) {
            return $tutor;
        } else {
            return false;
        }
    }

    public function register($email, $password) {
        $conn = Database::getInstance()->getConnection();
        $query = "INSERT INTO tutors (email, password) VALUES (:email, :password)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashedPassword);
        return $stmt->execute();
    }
}