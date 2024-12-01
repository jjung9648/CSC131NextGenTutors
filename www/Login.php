<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once 'db.php';

session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;

    if ($action === 'loginStudent') {
        $student_id = $_POST['student_id'] ?? null;
        $student_password = $_POST['student_password'] ?? null;

        try {
            $db = Database::getInstance()->getConnection();

            $query = "SELECT student_password FROM students WHERE student_id = :student_id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':student_id', $student_id, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $hashed_password = $row['student_password'];

                if (password_verify($student_password, $hashed_password)) {
                    // 로그인 성공 시 세션에 학생 ID 저장
                    $_SESSION['student_id'] = $student_id;

                    header("Location: StudentMain.php");
                    exit();
                } else {
                    echo "<script>alert('Invalid Student ID or Password. Please try again.');</script>";
                    echo "<script>window.location.href = 'Login.php';</script>";
                }
            } else {
                echo "<script>alert('Invalid Student ID or Password. Please try again.');</script>";
                echo "<script>window.location.href = 'Login.php';</script>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
} else {
    // HTML 파일 로드
    $loginHtmlFile = __DIR__ . '/Login.html'; // Login.html의 경로

    if (file_exists($loginHtmlFile)) {
        readfile($loginHtmlFile); // Login.html 내용을 출력
    } else {
        echo "Login.html file not found.";
    }
}
