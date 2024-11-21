<?php
require_once './Backend/config/db.php';

class TutorData {
    public static function getTutorHoursData($tutorId) {
        $conn = Database::getInstance()->getConnection();
        
        // Fetch tutor's name
        $query = "SELECT name FROM tutors WHERE id = :tutor_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':tutor_id', $tutorId);
        $stmt->execute();
        $tutor = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Fetch tutor hours
        $query = "SELECT week_start, hours FROM tutor_hours WHERE tutor_id = :tutor_id ORDER BY week_start ASC";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':tutor_id', $tutorId);
        $stmt->execute();
        $hours = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return [
            'tutor' => $tutor,
            'hours' => $hours
        ];
    }
}