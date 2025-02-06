<?php
require_once __DIR__ . '/../../config/database.php';

class Usuario {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // Nuevo método para buscar usuario por email
    public function buscarUsuarioPorEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM Usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna el usuario si existe
}
}
?>