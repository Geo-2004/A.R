<?php 
session_start(); 
if (!isset($_SESSION["usuario_id"]) || $_SESSION["tipo_usuario"] !== "administrador") { 
header("Location: ../views/dashboard.php"); 
exit(); 
} 
require_once __DIR__ . "../../../config/database.php";
global $conn;
 
$conn = Database::getConnection(); 
include 'layout.php'; 
// Obtener todos los usuarios 
$stmt = $conn->query("SELECT * FROM Usuarios"); 
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC); 
?> 
<div class="container mt-5"> 
<h2 class="text-center">Gestión de Usuarios</h2> 
<table class="table table-striped"> 
<thead> 
<tr> 
<th>Nombre</th> 
<th>Email</th> 
<th>Tipo</th> 
<th>Acciones</th> 
</tr> 
</thead> 
<tbody> 
<?php foreach ($usuarios as $usuario): ?> 
<tr> 
<td><?= htmlspecialchars($usuario['nombre']) ?></td> 
<td><?= htmlspecialchars($usuario['email']) ?></td> 
<td><?= htmlspecialchars($usuario['tipo_usuario']) ?></td> 
<td> 
<a href="../controllers/UsuarioController.php?convertir=<?= $usuario['id_usuario'] ?>" class="btn btn-warning btn-sm">Cambiar Rol</a> 
<a href="../controllers/UsuarioController.php?eliminar=<?= $usuario['id_usuario'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar usuario?')">Eliminar</a> 
</td> 
</tr> 
<?php endforeach; ?> 
</tbody> 
 </table> 
</div> 
