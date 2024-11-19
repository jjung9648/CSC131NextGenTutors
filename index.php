<?php
// index.php
require_once './Backend/config/db.php';

// Basic routing
$page = isset($_GET['page']) ? $_GET['page'] : 'notifications';

switch ($page) {
    case 'landing-page':
        include './Backend/includes/combined_login_register.php';
        break;
    case 'login':
        include './Frontend/log-in.html';
        break;
    case 'register':
        include './Frontend/registration-page.html';
        break;
    case 'payment':
        include './Frontend/payment-page.html';
        break;
    case 'tutor-dashboard':
        include './Frontend/tutor-dashboard.html';
        break;
    case 'student-dashboard':
        include './Frontend/student-dashboard.html';
        break;
    case 'tutor-page':
        include './Frontend/tutor-page.html';
        break;
    case 'schedule':
        include './Frontend/schedule.html';
        break;
    case 'performance':
        include './Frontend/performance.html';
        break;
    case 'performance-table':
        include './Frontend/performance-table.html';
        break;
    case 'login-register':
        include './Frontend/combined_login_register.php';
        break;
    case 'notifications':
        include './Backend/includes/notifications_and_settings.php';
        break;
    case 'student-data':
        include './Frontend/student_data.php';
        break;
    case 'tutor-hours':
        include './Frontend/tutor_hours.php';
        break;
    case 'users':
        include './Frontend/users.php';
        break;
    case 'tutors':
        include './Frontend/tutors.php';
        break;
    case 'home':
        include './Backend/includes/home.php';
        break;
    default:
        include './Backend/includes/404.php';
        break;
}