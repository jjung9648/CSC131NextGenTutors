<?php
// index.php
require_once '../config/db.php';
require_once '../includes/functions.php';

// Basic routing
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'home':
        include '../includes/home.php';
        break;
    case 'about':
        include '../includes/about.php';
        break;
    default:
        include '../includes/404.php';
        break;
}
?>