<?php
require_once __DIR__ . '/../config/db.php';

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

// Get Tutor Data


function getStudentData($studentId) {
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


// Get Tutor Hours Data
function getTutorHoursData($tutorId) {
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

function getUsers() {
    $conn = Database::getInstance()->getConnection();
    $query = "SELECT * FROM users";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getTutors() {
    $conn = Database::getInstance()->getConnection();
    $query = "SELECT * FROM tutors";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>