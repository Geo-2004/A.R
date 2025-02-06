<?php

class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        try {
            // Detectar si estamos en Heroku usando la variable de entorno JAWSDB_URL
            if (getenv("JAWSDB_URL")) {
                $url = parse_url(getenv("JAWSDB_URL"));

                $host = $url["host"];
                $dbname = substr($url["path"], 1); // Elimina la primera "/"
                $username = $url["user"];
                $password = $url["pass"];
            } else {
                // Datos locales (para pruebas en tu PC)
                $host = "localhost";
                $dbname = "sistema_reservas";
                $username = "root";
                $password = "";
            }

            $this->conn = new PDO(
                "mysql:host={$host};dbname={$dbname};charset=utf8mb4",
                $username,
                $password
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
