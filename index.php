<?php
// index.php
require_once './Backend/config/db.php';
require_once './Backend/includes/functions.php';

// Basic routing
$page = isset($_GET['page']) ? $_GET['page'] : 'GoogleLogIn';

switch ($page) {

    case 'GoogleLogIn':
        include './Frontend/GoogleLogInTest.html';
        break;
    case 'landing-page':
        include './Frontend/landing-page.html';
        break;
    case 'login':
        include './login.php';
        break;
    case 'home':
        include './Backend/includes/home.php';
        break;
    case 'callback':
        include './Backend/config/callback.php';
        break;  
    default:
        include './Backend/includes/404.php';
        break;
}