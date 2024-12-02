<?php
require_once __DIR__ . '/Backend/config/db.php';

try {
    $db = Database::getInstance();
    $conn = $db->getConnection();
    if ($conn) {
        echo "Database connection successful!";
    } else {
        echo "Database connection failed!";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>