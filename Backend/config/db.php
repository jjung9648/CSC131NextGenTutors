<?php
class Database {
    private static $instance = null;
    private $conn;

    private $host = 'localhost';
    private $db = 'mysql'; // Your database name
    private $user = 'root'; // Default username for XAMPP is 'root'
    private $pass = ''; // Default password for XAMPP is an empty string
    private $port = '3306'; // Ensure this matches the port MySQL is running on

    // Private constructor to prevent multiple instances
    private function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->db}", $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Prevent cloning of the instance
    private function __clone() {}

    // Prevent unserializing of the instance
    public function __wakeup() {}

    // Public method to get the single instance of the class
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Public method to get the database connection
    public function getConnection() {
        return $this->conn;
    }
}
?>