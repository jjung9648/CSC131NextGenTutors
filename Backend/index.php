<?php
// index.php
require_once 'db.php';

$url = "http://frontend/index.html";
$htmlContent = file_get_contents($url);

if ($htmlContent === FALSE) {
    echo "Failed to load HTML from frontend container.";
} else {
    echo $htmlContent;
}

// // Basic routing
// $page = isset($_GET['page']) ? $_GET['page'] : 'landing-page';

// switch ($page) {
//     case 'landing-page':
//         include 'combined_login_register.php';
//         break;
//     case 'login':
//         include '/Frontend/log-in.html';
//         break;
//     case 'register':
//         include '/Frontend/registration-page.html';
//         break;
//     case 'payment':
//         include '/Frontend/payment-page.html';
//         break;
//     case 'tutor-dashboard':
//         include '/Frontend/tutor-dashboard.html';
//         break;
//     case 'student-dashboard':
//         include '/Frontend/student-dashboard.html';
//         break;
//     case 'tutor-page':
//         include '/Frontend/tutor-page.html';
//         break;
//     case 'schedule':
//         include '/Frontend/schedule.html';
//         break;
//     case 'performance':
//         include '/Frontend/performance.html';
//         break;
//     case 'performance-table':
//         include '/Frontend/performance-table.html';
//         break;
//     case 'login-register':
//         include '/Backend/combined_login_register.php';
//         break;
//     case 'notifications':
//         include '/Backend/notifications_and_settings.php';
//         break;
//     case 'student-data':
//         include '/Backend/studentData.php';
//         break;
//     case 'tutor-hours':
//         include '/Backend/tutor_hours.php';
//         break;
//     case 'users':
//         include '/Backend/users.php';
//         break;
//     case 'tutors':
//         include '/Backend/tutors.php';
//         break;
//     case 'home':
//         include '/Backend/home.php';
//         break;
//     default:
//         include '/Backend/404.php';
//         break;
// }
?>