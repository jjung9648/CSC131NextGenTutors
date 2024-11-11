<?php
class Database {
    private static $instance = null;
    private $conn;

    private $host = 'my-new-db.cngy2e0i6hdm.us-east-2.rds.amazonaws.com';
    private $db = 'my-new-db';
    private $user = 'jjung2';
    private $pass = 'root-password';
    private $port = '3306';

    private function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db};port={$this->port}", $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>