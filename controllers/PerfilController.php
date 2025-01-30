<?php
require_once "../config/database.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["actualizar"])) {
    $id_usuario = $_POST["id_usuario"];
    $biografia = $_POST["biografia"] ?? '';

    // Manejo de la foto de perfil
    $foto = null;
    if (!empty($_FILES["foto"]["name"])) {
        $foto_nombre = time() . "_" . basename($_FILES["foto"]["name"]);
        $foto_ruta = "../uploads/" . $foto_nombre;

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $foto_ruta)) {
            $foto = $foto_nombre;
        }
    }

    // Verificar si ya existe un perfil
    $stmt = $conn->prepare("SELECT * FROM Perfiles WHERE id_usuario = ?");
    $stmt->execute([$id_usuario]);
    $perfil = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($perfil) {
        // Actualizar perfil existente
        if ($foto) {
            $stmt = $conn->prepare("UPDATE Perfiles SET foto = ?, biografia = ? WHERE id_usuario = ?");
            $stmt->execute([$foto, $biografia, $id_usuario]);
        } else {
            $stmt = $conn->prepare("UPDATE Perfiles SET biografia = ? WHERE id_usuario = ?");
            $stmt->execute([$biografia, $id_usuario]);
        }
    } else {
        // Insertar nuevo perfil
        $stmt = $conn->prepare("INSERT INTO Perfiles (id_usuario, foto, biografia) VALUES (?, ?, ?)");
        $stmt->execute([$id_usuario, $foto, $biografia]);
    }

    header("Location: ../views/perfil.php?mensaje=Perfil actualizado con éxito");
}
?>