<?php

class Database {
    private static $instance = null;
    private $conn;

    private $host = "localhost";
    private $dbname = "sistema_reservas";
    private $username = "root";
    private $password = "";

    private function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("SET NAMES 'utf8mb4'");
        } catch (PDOException $e) {
            exit("Error de conexión: " . $e->getMessage());
        }
    }

    public static function getConnection() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance->conn;
    }
}
?>
