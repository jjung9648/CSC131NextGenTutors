<?php
require_once 'db.php';

class Tutor implements User {
    private $pdo;

    // Constructor to initialize database connection
    public function __construct() {
        $this->pdo = getDatabaseConnection();
    }

    // Retrieve a specific tutor's hourly rate based on their name
    public function getTutorRate($tutorName) {
        $sql = "SELECT rate FROM tutors WHERE name = :name";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $tutorName, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['rate'] ?? null;
    }

    // Retrieve the session count for a specific tutor based on their name
    public function getTutorSessionCount($tutorName) {
        $sql = "
            SELECT COUNT(s.id) AS session_count
            FROM tutors t
            JOIN sessions s ON t.id = s.tutor_id
            WHERE t.name = :name
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $tutorName, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['session_count'] ?? 0;
    }

    // Retrieve the total hours for a specific tutor's sessions based on their name
    public function getTutorTotalHours($tutorName) {
        $sql = "
            SELECT SUM(s.hour) AS total_hours
            FROM tutors t
            JOIN sessions s ON t.id = s.tutor_id
            WHERE t.name = :name
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $tutorName, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['total_hours'] ?? 0;
    }

    // Calculate a specific tutor's total earnings (rate * total hours)
    public function getTutorEarnings($tutorName) {
        // Get tutor's hourly rate
        $rate = $this->getTutorRate($tutorName);

        // Get total hours for the tutor
        $totalHours = $this->getTutorTotalHours($tutorName);

        // Calculate and return earnings
        return $rate * $totalHours;
    }
}
?>
