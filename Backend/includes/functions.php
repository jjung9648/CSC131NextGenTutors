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
function getTutorData($tutorId) {
    $conn = Database::getInstance()->getConnection();
    
    // Fetch tutor's name
    $query = "SELECT name FROM tutors WHERE id = :tutor_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':tutor_id', $tutorId);
    $stmt->execute();
    $tutor = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Fetch assignments
    $query = "SELECT title, grade, date FROM assignments WHERE tutor_id = :tutor_id ORDER BY date ASC";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':tutor_id', $tutorId);
    $stmt->execute();
    $assignments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Calculate overall grade
    $query = "SELECT AVG(grade) as overall_grade FROM assignments WHERE tutor_id = :tutor_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':tutor_id', $tutorId);
    $stmt->execute();
    $overallGrade = $stmt->fetch(PDO::FETCH_ASSOC)['overall_grade'];
    
    return [
        'tutor' => $tutor,
        'assignments' => $assignments,
        'overall_grade' => $overallGrade
    ];
}
?>