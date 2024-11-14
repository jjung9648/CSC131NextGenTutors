<?php
require_once __DIR__ . '/studentData.php';
require_once __DIR__ . '/tutorData.php';
require_once __DIR__ . '/userDecorator.php';
require_once __DIR__ . '/tutor.php';
require_once __DIR__ . '/student.php';
require_once __DIR__ . '/loggingUserDecorator.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userType = $_POST['user_type'];
    $action = $_POST['action'];

    if ($userType == 'student') {
        $user = new LoggingUserDecorator(new Student());
    } else {
        $user = new LoggingUserDecorator(new Tutor());
    }

    if ($action == 'login') {
        $result = $user->signIn($email, $password);
        if ($result) {
            echo "Welcome, " . $result['name'];
        } else {
            echo "Invalid email or password.";
        }
    } elseif ($action == 'register') {
        $success = $user->register($email, $password);
        if ($success) {
            echo "Registration successful.";
        } else {
            echo "Registration failed.";
        }
    }
}
?>

<form method="POST" action="">
    <h2>Login</h2>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <select name="user_type" required>
        <option value="student">Student</option>
        <option value="tutor">Tutor</option>
    </select>
    <input type="hidden" name="action" value="login">
    <button type="submit">Login</button>
</form>

<form method="POST" action="">
    <h2>Register</h2>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <select name="user_type" required>
        <option value="student">Student</option>
        <option value="tutor">Tutor</option>
    </select>
    <input type="hidden" name="action" value="register">
    <button type="submit">Register</button>
</form>