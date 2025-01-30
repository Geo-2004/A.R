<?php
require_once '../config/database.php';

class LoginController {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];

            $stmt = $this->db->prepare("SELECT * FROM Usuarios WHERE email = ?");
            $stmt->execute([$email]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($password, $usuario['contraseña'])) {
                session_start();
                $_SESSION['usuario_id'] = $usuario['id_usuario'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];
                $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
                header("Location: ../views/dashboard.php");
                exit();
            } else {
                echo "Credenciales incorrectas.";
                exit();
            }
    }
}
}
?>