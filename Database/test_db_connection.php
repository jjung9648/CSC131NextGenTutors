<?php
require_once '../Backend/config/db.php'; // Update this path to the actual location of your db.php file

$conn = Database::getInstance()->getConnection();
if ($conn) {
    echo "Connection successful!";
} else {
    echo "Connection failed!";
}
?>