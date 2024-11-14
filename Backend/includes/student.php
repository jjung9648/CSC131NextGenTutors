<?php
require_once 'user.php';

class Student implements User {
    public function signIn($email, $password) {
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT * FROM students WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $student = $stmt->fetch();

        if ($student && password_verify($password, $student['password'])) {
            return $student;
        } else {
            return false;
        }
    }

    public function register($email, $password) {
        $conn = Database::getInstance()->getConnection();
        $query = "INSERT INTO students (email, password) VALUES (:email, :password)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));
        return $stmt->execute();
    }
}