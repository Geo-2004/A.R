<?php 
session_start(); 
if (!isset($_SESSION["usuario_id"]) || $_SESSION["tipo_usuario"] !== "administrador") { 
header("Location: ../views/dashboard.php"); 
exit(); 
} 
include 'layout.php'; 
?> 
<div class="container mt-5"> 
<h2 class="text-center">Agregar Nueva Actividad</h2> 
<form action="../controllers/ActividadController.php" method="POST"> 
<div class="mb-3"> 
<label class="form-label">Nombre</label> 
<input type="text" name="nombre" class="form-control" required> 
</div> 
<div class="mb-3"> 
<label class="form-label">Descripción</label> 
<textarea name="descripcion" class="form-control" required></textarea> 
</div> 
<div class="mb-3"> 
<label class="form-label">Precio</label> 
<input type="number" name="precio" class="form-control" step="0.01" required> 
</div> 
<div class="mb-3"> 
<label class="form-label">Ubicación</label> 
<input type="text" name="ubicacion" class="form-control"> 
</div> 
<button type="submit" name="agregar" class="btn btn-success">Agregar Actividad</button> 
  </form> 
</div>
