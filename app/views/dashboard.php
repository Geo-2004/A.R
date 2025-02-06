<?php 
include 'layout.php'; 
require_once __DIR__ . '/../../background.php'; 

session_start(); 

// Verificar si el usuario está autenticado
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php"); 
    exit();
}
?>

<style>
body {
    background: url('<?= $rutaFondoDashboard ?>') no-repeat center center fixed;
    background-size: cover;
    position: relative;
    color: white;
}

body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6); /* Oscurecer fondo */
    z-index: -1;
}

.menu-container {
    background: rgba(255, 255, 255, 0.15); 
    backdrop-filter: blur(10px);
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease;
}

.menu-container:hover {
    transform: scale(1.02);
}

.menu-container h2 {
    font-weight: bold;
    text-transform: uppercase;
}

.menu {
    list-style: none;
    padding: 0;
}

.menu li {
    margin: 15px 0;
}

.menu a {
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.2);
    padding: 10px;
    border-radius: 10px;
    color: white;
    text-decoration: none;
    font-size: 18px;
    font-weight: bold;
    transition: background 0.3s ease, transform 0.2s ease;
}

.menu a i {
    margin-right: 8px;
}

.menu a:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.05);
}

.logout-btn {
    margin-top: 20px;
    font-weight: bold;
}
</style>

<div class="container vh-100 d-flex flex-column align-items-center justify-content-center">
    <div class="menu-container text-center p-4">
        <h2 class="fw-bold text-uppercase">Bienvenido, <?= htmlspecialchars($_SESSION["nombre"]) ?></h2>
        <p class="lead">Has iniciado sesión como <strong><?= htmlspecialchars($_SESSION["tipo_usuario"]) ?></strong></p>
        <ul class="menu">
            <li><a href="perfil.php"><i class="bi bi-person-gear"></i> Perfil</a></li>
            <li><a href="reservar.php"><i class="bi bi-calendar-check"></i> Reservar una Actividad</a></li>
            <li><a href="mis_reservas.php"><i class="bi bi-list-check"></i> Mis Reservas</a></li>
            <li><a href="gestionar_actividades.php"><i class="bi bi-pencil-square"></i> Agregar o Eliminar Actividades</a></li>
            <?php if (isset($_SESSION["usuario_id"]) && $_SESSION["tipo_usuario"] === "administrador") : ?>
                <li><a href="admin_panel.php"><i class="bi bi-person-gear"></i> Administración</a></li>
            <?php endif; ?>
        </ul>
        <a href="../controllers/LogoutController.php" class="btn btn-danger w-100 logout-btn">
            <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
        </a>
    </div>
</div>
