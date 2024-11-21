<?php
require_once './Backend/config/db.php';

class getUserData {
    public static function getUsers() {
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT * FROM users";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getTutors() {
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT * FROM tutors";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}