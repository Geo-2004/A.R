<?php include 'layout.php'; ?>
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4 rounded-4" style="max-width: 400px; width: 100%;">
        <div class="card-body">
            <h2 class="text-center mb-4 fw-bold text-primary">Iniciar Sesión</h2>

            <!-- Mensajes de error y éxito -->
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger text-center p-2"><?= htmlspecialchars($_GET['error']) ?></div>
            <?php endif; ?>
            <?php if (isset($_GET['registro']) && $_GET['registro'] == 'exitoso'): ?>
                <div class="alert alert-success text-center p-2">Registro exitoso. Ahora puedes iniciar sesión.</div>
            <?php endif; ?>

            <!-- Formulario -->
            <form action="../controllers/AuthController.php" method="POST" class="mt-3">
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

            <!-- Enlace de recuperación de contraseña -->
            <div class="text-center mt-3">
                <a href="recuperar.php" class="text-decoration-none text-muted small">¿Olvidaste tu contraseña?</a>
                <div class="text-center mt-3">
                <a href="registro.php" class="text-decoration-none text-muted small">¿Registrarse?</a>
                </div>
            </div>
        </div>
    </div>
</div>
