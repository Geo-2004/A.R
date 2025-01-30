<?php
require_once "../config/database.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $email = $_POST["email"];
    $contraseña = $_POST["contraseña"];

    $stmt = $conn->prepare("SELECT id_usuario, nombre, contraseña, tipo_usuario FROM Usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($contraseña, $usuario["contraseña"])) {
        $_SESSION["usuario_id"] = $usuario["id_usuario"];
        $_SESSION["nombre"] = $usuario["nombre"];
        $_SESSION["tipo_usuario"] = $usuario["tipo_usuario"];
        header("Location: ../views/dashboard.php");
        exit();
    } else {
        header("Location: ../views/login.php?error=Credenciales incorrectas");
        exit();
}
}
?>