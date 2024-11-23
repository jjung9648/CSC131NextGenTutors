<?php
require_once './Backend/config/db.php';

class Notification {
    public static function addNotification($userId, $message) {
        $conn = Database::getInstance()->getConnection();
        $query = "INSERT INTO notifications (user_id, message) VALUES (:user_id, :message)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':message', $message);
        return $stmt->execute();
    }

    public static function getNotifications($userId) {
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT * FROM notifications WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function setUserPreference($userId, $receiveEmail) {
        $conn = Database::getInstance()->getConnection();
        $query = "INSERT INTO user_preferences (user_id, receive_email) VALUES (:user_id, :receive_email)
        ON DUPLICATE KEY UPDATE receive_email = :receive_email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':receive_email', $receiveEmail, PDO::PARAM_BOOL);
        return $stmt->execute();
    }

    public static function getUserPreference($userId) {
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT receive_email FROM user_preferences WHERE user_id = :user_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}