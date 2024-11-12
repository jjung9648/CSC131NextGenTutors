<?php
// index.php
require_once './Backend/config/db.php';
require_once './Backend/includes/functions.php';

// Basic routing
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'landing-page':
        include './Frontend/landing-page.html';
        break;
    case 'login':
        include './Frontend/login.html';
        break;

    case 'home':
        include './Backend/includes/home.php';
        break;
    default:
        include './Backend/includes/404.php';
        break;
}
?>