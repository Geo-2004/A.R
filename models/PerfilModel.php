<?php
require_once "../config/database.php";

class PerfilModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function obtenerPerfil($id_usuario) {
        $stmt = $this->conn->prepare("SELECT * FROM Perfiles WHERE id_usuario = ?");
        $stmt->execute([$id_usuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarPerfil($id_usuario, $foto, $biografia) {
        $stmt = $this->conn->prepare("UPDATE Perfiles SET foto = ?, biografia = ? WHERE id_usuario = ?");
        return $stmt->execute([$foto, $biografia, $id_usuario]);
    }

    public function crearPerfil($id_usuario, $foto, $biografia) {
        $stmt = $this->conn->prepare("INSERT INTO Perfiles (id_usuario, foto, biografia) VALUES (?, ?, ?)");
        return $stmt->execute([$id_usuario, $foto, $biografia]);
}
}