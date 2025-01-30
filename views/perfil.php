<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

require_once "../config/database.php";
include 'layout.php';

$id_usuario = $_SESSION["usuario_id"];

// Obtener perfil del usuario
$stmt = $conn->prepare("SELECT * FROM Perfiles WHERE id_usuario = ?");
$stmt->execute([$id_usuario]);
$perfil = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <h2 class="text-center">Mi Perfil</h2>

    <div class="text-center">
        <img src="<?= $perfil['foto'] ? '../uploads/' . $perfil['foto'] : '../uploads/default.png' ?>" 
             alt="Foto de perfil" class="img-thumbnail" width="150">
    </div>

    <form action="../controllers/PerfilController.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_usuario" value="<?= $id_usuario ?>">

        <div class="mb-3">
            <label class="form-label">Foto de Perfil</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Biografía</label>
            <textarea name="biografia" class="form-control"><?= htmlspecialchars($perfil['biografia'] ?? '') ?></textarea>
        </div>

        <button type="submit" name="actualizar" class="btn btn-primary">Actualizar Perfil</button>
    </form>
</div>