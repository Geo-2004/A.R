<?php 
include 'layout.php'; 
require_once __DIR__ . '/../../background.php'; // Ahora carga la imagen correctamente desde la raíz
?>

<style>
body {
    background: url('<?= $rutaFondoLogin ?>') no-repeat center center fixed;
    background-size: cover;
}
</style>

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4 rounded-4" style="max-width: 400px; width: 100%;">
        <div class="card-body">
            <h2 class="text-center mb-4 fw-bold text-primary">Iniciar Sesión</h2>
            <form action="../controllers/AuthController.php" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control rounded-3 p-2" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Contraseña</label>
                    <input type="password" name="contraseña" class="form-control rounded-3 p-2" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary w-100 py-2 rounded-3 fw-bold">
                    <i class="bi bi-box-arrow-in-right"></i> Ingresar
                </button>
            </form>
        </div>
    </div>
</div>