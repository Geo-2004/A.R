<?php
session_start();
if (!isset($_SESSION["usuario_id"]) || $_SESSION["tipo_usuario"] !== "administrador") {
    header("Location: dashboard.php");
    exit();
}

require_once "../config/database.php";
include 'layout.php';

// Obtener todas las actividades
$stmt = $conn->query("SELECT * FROM Actividades");
$actividades = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <h2 class="text-center">Gestión de Actividades</h2>

    <a href="agregar_actividad.php" class="btn btn-success mb-3">Agregar Nueva Actividad</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Ubicación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($actividades as $actividad): ?>
                <tr>
                    <td><?= htmlspecialchars($actividad['nombre']) ?></td>
                    <td><?= htmlspecialchars($actividad['descripcion']) ?></td>
                    <td>$<?= number_format($actividad['precio'], 2) ?></td>
                    <td><?= htmlspecialchars($actividad['ubicacion']) ?></td>
                    <td>
                        <a href="editar_actividad.php?id=<?= $actividad['id_actividad'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="../controllers/ActividadController.php?eliminar=<?= $actividad['id_actividad'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta actividad?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
   </table>
</div>