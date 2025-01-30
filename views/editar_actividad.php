<?php
session_start();
if (!isset($_SESSION["usuario_id"]) || $_SESSION["tipo_usuario"] !== "administrador") {
    header("Location: dashboard.php");
    exit();
}
require_once "../config/database.php";
include 'layout.php';

if (!isset($_GET["id"])) {
    header("Location: gestionar_actividades.php");
    exit();
}

$id_actividad = $_GET["id"];
$stmt = $conn->prepare("SELECT * FROM Actividades WHERE id_actividad = ?");
$stmt->execute([$id_actividad]);
$actividad = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$actividad) {
    header("Location: gestionar_actividades.php");
    exit();
}
?>

<div class="container mt-5">
    <h2 class="text-center">Editar Actividad</h2>

    <form action="../controllers/ActividadController.php" method="POST">
        <input type="hidden" name="id_actividad" value="<?= $actividad['id_actividad'] ?>">

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($actividad['nombre']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" required><?= htmlspecialchars($actividad['descripcion']) ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" name="precio" class="form-control" step="0.01" value="<?= $actividad['precio'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Ubicación</label>
            <input type="text" name="ubicacion" class="form-control" value="<?= htmlspecialchars($actividad['ubicacion']) ?>">
        </div>
        <button type="submit" name="editar" class="btn btn-warning">Actualizar Actividad</button>
  </form>
</div>