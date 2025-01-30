<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}
require_once "../config/database.php";
include 'layout.php';

// Obtener todas las actividades
$stmt = $conn->query("SELECT * FROM Actividades");
$actividades = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Estilos personalizados -->
<style>
    body {
        background: linear-gradient(to right, #00c6ff, #0072ff);
        font-family: 'Poppins', sans-serif;
    }

    .card-custom {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 12px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        padding: 20px;
        transition: transform 0.3s ease-in-out;
    }

    .card-custom:hover {
        transform: scale(1.02);
    }

    .btn-custom {
        background: #28a745;
        color: white;
        font-weight: bold;
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
    }

    .btn-custom:hover {
        background: #218838;
        transform: scale(1.05);
    }

    select {
        padding: 10px;
        border-radius: 8px;
    }
</style>

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card card-custom p-4" style="max-width: 500px; width: 100%;">
        <h2 class="text-center text-primary fw-bold">Reservar Actividad</h2>
        <p class="text-center text-muted">Selecciona una actividad y asegura tu lugar.</p>

        <form action="../controllers/ReservaController.php" method="POST">
            <div class="mb-3">
                <label class="form-label fw-semibold">Selecciona una actividad</label>
                <select name="id_actividad" class="form-control" required>
                    <?php foreach ($actividades as $actividad): ?>
                        <option value="<?= $actividad['id_actividad'] ?>">
                            <?= htmlspecialchars($actividad['nombre']) ?> - $<?= $actividad['precio'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="reservar" class="btn btn-custom w-100">
                <i class="bi bi-calendar-check"></i> Reservar
            </button>
        </form>
    </div>
</div>
