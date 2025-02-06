<?php
require_once __DIR__ . '/../models/Usuario.php';
session_start();

class LoginController {
    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
            $email = $_POST['email'];
            $contraseña = $_POST['contraseña'];

            $usuario = new Usuario(); // Suponiendo que Usuario.php maneja la autenticación
            $user = $usuario->buscarUsuarioPorEmail($email); // Método que obtendría el usuario desde la BD

            if ($user && password_verify($contraseña, $user['contraseña'])) {
                $_SESSION['usuario'] = $user;

                // ✅ Redirección según el rol del usuario
                if ($user['tipo_usuario'] === 'administrador') {
                    header("Location: ../views/inicio.php?action=admin_panel");
                } else {
                    header("Location: ../views/inicio.php?action=dashboard");
                }
                exit();
            } else {
                header("Location: ../views/inicio.php?action=login&error=Credenciales incorrectas");
                exit();
            }
        }
    }

    public function logout() {
        session_destroy();
        header("Location: ../views/inicio.php?action=login");
        exit();
    }
}

// ✅ Llamar funciones según la acción
if (isset($_POST['login'])) {
    $controller = new LoginController();
    $controller->login();
}

if (isset($_GET['logout'])) {
    $controller = new LoginController();
    $controller->logout();
}
?>