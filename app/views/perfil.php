<?php 
session_start(); 

if (!isset($_SESSION["usuario_id"])) { 
    header("Location: ../views/login.php"); 
    exit(); 
} 

require_once __DIR__ . "/../../config/database.php"; 

$conn = Database::getConnection();
include 'layout.php'; 

$id_usuario = $_SESSION["usuario_id"]; 

// Verificar la conexión
if (!$conn) {
    die("Error: No se pudo conectar a la base de datos.");
}

// Obtener perfil del usuario
$stmt = $conn->prepare("SELECT * FROM Perfiles WHERE id_usuario = ?"); 
$stmt->execute([$id_usuario]); 
$perfil = $stmt->fetch(PDO::FETCH_ASSOC); 

// Verificar si tiene imagen de perfil
$rutaImagen = isset($perfil['foto']) && !empty($perfil['foto']) 
    ? "/proyecto_final/uploads/" . htmlspecialchars($perfil['foto']) 
    : "/uploads/default.png";
?> 

<div class="container mt-5"> 
    <h2 class="text-center text-primary mb-4">Mi Perfil</h2> 
    <div class="row justify-content-center mb-4"> 
        <div class="col-12 col-md-6 text-center"> 
            <img src="<?= $rutaImagen ?>" 
                alt="Foto de perfil" 
                class="img-thumbnail rounded-circle border-0 shadow" width="150"> 
        </div> 
    </div> 

    <form action="../controllers/PerfilController.php" method="POST" enctype="multipart/form-data"> 
        <input type="hidden" name="id_usuario" value="<?= $id_usuario ?>"> 

        <div class="mb-3"> 
            <label class="form-label fs-5">Foto de Perfil</label> 
            <input type="file" name="foto" class="form-control shadow-sm" accept="image/*"> 
        </div> 

        <div class="mb-3"> 
            <label class="form-label fs-5">Biografía</label> 
            <textarea name="biografia" class="form-control shadow-sm" rows="5"><?= htmlspecialchars($perfil['biografia'] ?? '') ?></textarea> 
        </div> 

        <button type="submit" name="actualizar" class="btn btn-primary w-100 py-2 fs-5 shadow-sm">Actualizar Perfil</button> 
    </form> 
</div> 

<!-- Agregar estilos CSS adicionales --> 
<style> 
.container { 
    max-width: 600px; 
} 
.img-thumbnail { 
    border-radius: 50%; 
    object-fit: cover; 
} 
</style>
