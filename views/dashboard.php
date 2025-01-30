<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

include 'layout.php';
?>

<!-- Estilos personalizados -->
<style>
    body {
        background: linear-gradient(to right, #0062E6, #33AEFF);
        color: white;
        font-family: 'Poppins', sans-serif;
    }

    .menu-container {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(10px);
    }

    .menu a {
        display: flex;
        align-items: center;
        padding: 12px;
        border-radius: 10px;
        color: white;
        font-weight: bold;
        text-decoration: none;
        transition: all 0.3s ease-in-out;
    }

    .menu a:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: scale(1.05);
    }

    .menu i {
        margin-right: 10px;
    }

    .logout-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 10px;
        border-radius: 10px;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
    }

    .logout-btn:hover {
        transform: scale(1.05);
    }
</style>

<div class="container vh-100 d-flex flex-column align-items-center justify-content-center">
    <div class="menu-container text-center p-4">
        <h2 class="fw-bold text-uppercase">Bienvenido, <?= htmlspecialchars($_SESSION["nombre"]) ?></h2>
        <p class="lead">Has iniciado sesión como <strong><?= htmlspecialchars($_SESSION["tipo_usuario"]) ?></strong></p>

        <ul class="list-unstyled menu">
            <li><a href="perfil.php"><i class="bi bi-person-gear"></i> perfil</a></li>
            <li><a href="reservar.php"><i class="bi bi-calendar-check"></i> Reserva una Actividad</a></li>
            <li><a href="mis_reservas.php"><i class="bi bi-list-check"></i> Mis Reservas</a></li>
            <li><a href="gestionar_actividades.php"><i class="bi bi-pencil-square"></i> Agrega o Elimina Actividades</a></li>
            <li><a href="admin_panel.php"><i class="bi bi-person-gear"></i> Administración</a></li>
            
        </ul>

        <a href="../controllers/LogoutController.php" class="btn btn-danger w-100 logout-btn">
            <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
        </a>
    </div>
</div>
