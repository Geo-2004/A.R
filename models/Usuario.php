<?php
require_once "../config/database.php";

class Usuario {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function crearUsuario($nombre, $email, $contraseña) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO Usuarios (nombre, email, contraseña) VALUES (?, ?, ?)");
            return $stmt->execute([$nombre, $email, $contraseña]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
    }
}
}
?>