<?php
session_start();
if (!isset($_SESSION["usuario_id"]) || $_SESSION["tipo_usuario"] !== "administrador") {
    header("Location: dashboard.php");
    exit();
}
include 'layout.php';
?>

<div class="container mt-5">
    <h2 class="text-center">Panel de Administración</h2>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-text">Gestionar los usuarios registrados.</p>
                    <a href="gestionar_usuarios.php" class="btn btn-primary">Ir</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Actividades</h5>
                    <p class="card-text">Administrar actividades disponibles.</p>
                    <a href="gestionar_actividades.php" class="btn btn-primary">Ir</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Reservas</h5>
                    <p class="card-text">Ver y gestionar las reservas de los usuarios.</p>
                    <a href="gestionar_reservas.php" class="btn btn-primary">Ir</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Pagos</h5>
                    <p class="card-text">Controlar los pagos realizados.</p>
                    <a href="pagar.php" class="btn btn-primary">Ir</a>
                </div>
            </div>
        </div>
    </div>
</div>