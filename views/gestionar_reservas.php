<?php
session_start();
if (!isset($_SESSION["usuario_id"]) || $_SESSION["tipo_usuario"] !== "administrador") {
    header("Location: dashboard.php");
    exit();
}

require_once "../config/database.php";
include 'layout.php';

$stmt = $conn->query("SELECT r.id_reserva, u.nombre AS usuario, a.nombre AS actividad, r.estado, r.fecha_reserva
                      FROM Reservas r
                      JOIN Usuarios u ON r.id_usuario = u.id_usuario
                      JOIN Actividades a ON r.id_actividad = a.id_actividad");
$reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <h2 class="text-center">Gestión de Reservas</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Actividad</th>
                <th>Estado</th>
                <th>Fecha de Reserva</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservas as $reserva): ?>
                <tr>
                    <td><?= htmlspecialchars($reserva['usuario']) ?></td>
                    <td><?= htmlspecialchars($reserva['actividad']) ?></td>
                    <td><?= htmlspecialchars($reserva['estado']) ?></td>
                    <td><?= $reserva['fecha_reserva'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>