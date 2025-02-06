<?php 
session_start(); 
if (!isset($_SESSION["usuario_id"]) || $_SESSION["tipo_usuario"] !== "administrador") { 
    header("Location: ../views/dashboard.php"); 
    exit(); 
} 
include 'layout.php'; 
?> 

<div class="container mt-5">
    <h2 class="text-center mb-4">Panel de Administración</h2>

    <div class="row text-center">
        <!-- Card de Usuarios -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-lg rounded">
                <div class="card-body">
                    <h5 class="card-title text-primary">Usuarios</h5>
                    <p class="card-text">Gestionar los usuarios registrados.</p>
                    <a href="gestionar_usuarios.php" class="btn btn-primary w-100">Ir</a>
                </div>
            </div>
        </div>

        <!-- Card de Actividades -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-lg rounded">
                <div class="card-body">
                    <h5 class="card-title text-primary">Actividades</h5>
                    <p class="card-text">Administrar actividades disponibles.</p>
                    <a href="gestionar_actividades.php" class="btn btn-primary w-100">Ir</a>
                </div>
            </div>
        </div>

        <!-- Card de Reservas -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-lg rounded">
                <div class="card-body">
                    <h5 class="card-title text-primary">Reservas</h5>
                    <p class="card-text">Ver y gestionar las reservas de los usuarios.</p>
                    <a href="gestionar_reservas.php" class="btn btn-primary w-100">Ir</a>
                </div>
            </div>
        </div>

        <!-- Card de Pagos -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-lg rounded">
                <div class="card-body">
                    <h5 class="card-title text-primary">Pagos</h5>
                    <p class="card-text">Controlar los pagos realizados.</p>
                    <a href="pagar.php" class="btn btn-primary w-100">Ir</a>
                </div>
            </div>
        </div>

        <!-- Card de Fondos -->
        <div class="col-md-12 mb-4">
            <div class="card shadow-lg rounded">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary">Fondos</h5>
                    <p>Cambiar imágenes de fondo de la plataforma.</p>
                    <button class="btn btn-dark w-50" onclick="toggleFondos()">Administrar Fondos</button>
                </div>
            </div>
        </div>

        <!-- Sección de Fondos (oculta por defecto) -->
        <div id="fondosSection" class="col-md-12 mb-4" style="display: none;">
            <div class="card shadow-lg rounded">
                <div class="card-body">
                    <h5 class="card-title text-center text-primary">Actualizar Imágenes de Fondo</h5>

                    <div class="row">
                        <!-- Fondo de Inicio -->
                        <div class="col-md-4">
                            <form action="../controllers/FondoController.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="tipo_fondo" value="inicio">
                                <div class="mb-3">
                                    <label class="form-label">Fondo de Inicio:</label>
                                    <input type="file" name="imagen" class="form-control" accept="image/*" required>
                                </div>
                                <button type="submit" name="subir" class="btn btn-success w-100">Actualizar</button>
                            </form>
                        </div>

                        <!-- Fondo de Login -->
                        <div class="col-md-4">
                            <form action="../controllers/FondoController.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="tipo_fondo" value="login">
                                <div class="mb-3">
                                    <label class="form-label">Fondo de Login:</label>
                                    <input type="file" name="imagen" class="form-control" accept="image/*" required>
                                </div>
                                <button type="submit" name="subir" class="btn btn-warning w-100">Actualizar</button>
                            </form>
                        </div>

                        <!-- Fondo de Dashboard -->
                        <div class="col-md-4">
                            <form action="../controllers/FondoController.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="tipo_fondo" value="dashboard">
                                <div class="mb-3">
                                    <label class="form-label">Fondo de Dashboard:</label>
                                    <input type="file" name="imagen" class="form-control" accept="image/*" required>
                                </div>
                                <button type="submit" name="subir" class="btn btn-primary w-100">Actualizar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function toggleFondos() {
        var section = document.getElementById("fondosSection");
        if (section.style.display === "none") {
            section.style.display = "block";
        } else {
            section.style.display = "none";
        }
    }
</script>

<style> 
.card { 
    border-radius: 10px; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
} 
.card-title { 
    font-weight: bold; 
} 
.card-body { 
    padding: 20px; 
} 
.btn { 
    font-size: 16px; 
    padding: 12px; 
} 
.w-100 { 
    width: 100%; 
} 
h2 { 
    font-size: 2.5rem; 
    color: #333; 
} 
p { 
    font-size: 1.1rem; 
    color: #666; 
} 
.text-primary { 
    color: #007bff !important; 
} 
.btn-primary { 
    background-color: #007bff; 
    border-color: #007bff; 
} 
.btn-primary:hover { 
    background-color: #0056b3; 
    border-color: #004085; 
} 
.btn-success { 
    background-color: #28a745; 
    border-color: #28a745; 
} 
.btn-success:hover { 
    background-color: #218838; 
    border-color: #1e7e34; 
} 
.btn-warning { 
    background-color: #ffc107; 
    border-color: #ffc107; 
} 
.btn-warning:hover { 
    background-color: #e0a800; 
    border-color: #d39e00; 
}
.btn-dark {
    background-color: #343a40;
    border-color: #343a40;
}
.btn-dark:hover {
    background-color: #23272b;
    border-color: #1d2124;
}
</style>
>
