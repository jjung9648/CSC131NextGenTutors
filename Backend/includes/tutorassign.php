<?php
require_once 'db.php';

class Tutorassi {
    private $pdo;

    // Constructor to initialize database connection
    public function __construct() {
        $this->pdo = getDatabaseConnection();
    }

    // Retrieve subject and tutor name for a specific student
    public function getStudentClasses($studentName) {
        $sql = "
            SELECT c.subject, t.name AS tutor_name
            FROM classes c
            JOIN tutors t ON c.tutor_id = t.id
            JOIN students s ON c.student_id = s.id
            WHERE s.name = :studentName
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':studentName', $studentName, PDO::PARAM_STR);
        $stmt->execute();

        // Fetch results as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Retrieve class name and student name for a specific tutor
    public function getTutorClasses($tutorName) {
        $sql = "
            SELECT c.subject AS class_name, s.name AS student_name
            FROM classes c
            JOIN tutors t ON c.tutor_id = t.id
            JOIN students s ON c.student_id = s.id
            WHERE t.name = :tutorName
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tutorName', $tutorName, PDO::PARAM_STR);
        $stmt->execute();

        // Fetch results as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Retrieve all sessions for a specific class
    public function getClassSessions($classId) {
        $sql = "
            SELECT s.id AS session_id, s.date, s.duration
            FROM sessions s
            WHERE s.class_id = :classId
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':classId', $classId, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch results as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Retrieve task(s) for a specific session
    public function getSessionTasks($sessionId) {
        $sql = "
            SELECT t.id AS task_id, t.description
            FROM tasks t
            WHERE t.session_id = :sessionId
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':sessionId', $sessionId, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch results as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
