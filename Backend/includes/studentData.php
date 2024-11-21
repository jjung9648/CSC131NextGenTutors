<?php
require_once './Backend/config/db.php';

class StudentData {
    public static function getStudentData($studentId) {
        $conn = Database::getInstance()->getConnection();
        
        // Fetch student's name
        $query = "SELECT name FROM students WHERE id = :student_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':student_id', $studentId);
        $stmt->execute();
        $student = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Fetch subjects
        $query = "SELECT s.name AS subject, p.grade, a.status, t.name AS tutor
                  FROM subjects s
                  JOIN performance p ON s.id = p.subject_id
                  JOIN attendance a ON s.id = a.subject_id AND p.student_id = a.student_id
                  JOIN tutors t ON p.tutor_id = t.id
                  WHERE p.student_id = :student_id
                  ORDER BY s.name ASC";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':student_id', $studentId);
        $stmt->execute();
        $subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Calculate overall grade
        $query = "SELECT AVG(grade) as overall_grade FROM performance WHERE student_id = :student_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':student_id', $studentId);
        $stmt->execute();
        $overallGrade = $stmt->fetch(PDO::FETCH_ASSOC)['overall_grade'];
        
        return [
            'student' => $student,
            'subjects' => $subjects,
            'overall_grade' => $overallGrade
        ];
    }
}