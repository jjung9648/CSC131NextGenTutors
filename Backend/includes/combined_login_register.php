<?php
require_once __DIR__ . '/studentData.php';
require_once __DIR__ . '/tutorData.php';
require_once __DIR__ . '/userDecorator.php';
require_once __DIR__ . '/tutor.php';
require_once __DIR__ . '/student.php';
require_once __DIR__ . '/loggingUserDecorator.php';
require_once __DIR__ . '/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $email = $data['email'];
    $password = $data['password'];
    $userType = $data['user_type'];
    $action = $data['action'];

    $db = Database::getInstance();
    $conn = $db->getConnection();

    if ($action == 'login') {
        try {
            if ($userType == 'student') {
                $stmt = $conn->prepare("SELECT * FROM students WHERE email = :email");
            } else {
                $stmt = $conn->prepare("SELECT * FROM tutors WHERE email = :email");
            }
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_type'] = $userType;
                echo json_encode(['success' => true, 'message' => "Welcome, " . $user['name']]);
            } else {
                echo json_encode(['success' => false, 'message' => "Invalid email or password."]);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => "Database error: " . $e->getMessage()]);
        }
    } elseif ($action == 'register') {
        try {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            if ($userType == 'student') {
                $stmt = $conn->prepare("INSERT INTO students (email, password) VALUES (:email, :password)");
            } else {
                $stmt = $conn->prepare("INSERT INTO tutors (email, password) VALUES (:email, :password)");
            }
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $success = $stmt->execute();

            if ($success) {
                echo json_encode(['success' => true, 'message' => "Registration successful."]);
            } else {
                echo json_encode(['success' => false, 'message' => "Registration failed."]);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => "Database error: " . $e->getMessage()]);
        }
    }
}
?>