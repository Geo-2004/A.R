<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}
require_once "../config/database.php";
include 'layout.php';

$id_usuario = $_SESSION["usuario_id"];
$stmt = $conn->prepare("SELECT r.id_reserva, a.nombre, r.estado, r.fecha_reserva 
                        FROM Reservas r 
                        JOIN Actividades a ON r.id_actividad = a.id_actividad 
                        WHERE r.id_usuario = ?");
$stmt->execute([$id_usuario]);
$reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="container mt-5">
    <h2 class="text-center mb-4">Mis Reservas</h2>
    
    <form action="pagar.php" method="GET">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">Seleccionar</th>
                        <th>Actividad</th>
                        <th>Estado</th>
                        <th>Fecha de Reserva</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservas as $reserva): ?>
                        <tr>
                            <td class="text-center">
                                <?php if ($reserva['estado'] == 'pendiente'): ?>
                                    <input type="checkbox" name="id_reservas[]" value="<?= $reserva['id_reserva'] ?>" class="form-check-input">
                                <?php else: ?>
                                    <span class="badge bg-secondary"><?= htmlspecialchars($reserva['estado']) ?></span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($reserva['nombre']) ?></td>
                            <td>
                                <span class="badge 
                                    <?= $reserva['estado'] == 'pendiente' ? 'bg-warning text-dark' : 'bg-success' ?>">
                                    <?= htmlspecialchars($reserva['estado']) ?>
                                </span>
                            </td>
                            <td><?= $reserva['fecha_reserva'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-success px-4 py-2">Pagar Seleccionadas</button>
        </div>
    </form>
</div>
