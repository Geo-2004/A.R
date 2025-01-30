<?php
require_once "../models/Usuario.php";
require_once "../config/database.php";

class UsuarioController {
    private $usuarioModel;

    public function __construct($conn) {
        $this->usuarioModel = new Usuario($conn);
    }

    public function registrarUsuario() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["registrar"])) {
            $nombre = $_POST["nombre"];
            $email = $_POST["email"];
            $contraseña = password_hash($_POST["contraseña"], PASSWORD_BCRYPT);

            if ($this->usuarioModel->crearUsuario($nombre, $email, $contraseña)) {
                header("Location: ../views/login.php?registro=exitoso");
            } else {
                echo "Error al registrar usuario.";
            }
        }
    }
}
// Cambiar rol de usuario
if (isset($_GET["convertir"])) {
    $id_usuario = $_GET["convertir"];

    // Obtener el tipo de usuario actual
    $stmt = $conn->prepare("SELECT tipo_usuario FROM Usuarios WHERE id_usuario = ?");
    $stmt->execute([$id_usuario]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        $nuevo_tipo = ($usuario["tipo_usuario"] === "cliente") ? "administrador" : "cliente";
        $stmt = $conn->prepare("UPDATE Usuarios SET tipo_usuario = ? WHERE id_usuario = ?");
        $stmt->execute([$nuevo_tipo, $id_usuario]);

        header("Location: ../views/gestionar_usuarios.php?mensaje=Rol actualizado");
    }
}

// Eliminar usuario
if (isset($_GET["eliminar"])) {
    $id_usuario = $_GET["eliminar"];

    $stmt = $conn->prepare("DELETE FROM Usuarios WHERE id_usuario = ?");
    $stmt->execute([$id_usuario]);

    header("Location: ../views/gestionar_usuarios.php?mensaje=Usuario eliminado");
}

$usuarioController = new UsuarioController($conn);
$usuarioController->registrarUsuario();
?>