<?php 
session_start(); 
if (!isset($_SESSION["usuario_id"])) { 
header("Location: ../views/login.php"); 
exit(); 
} 
require_once __DIR__ . "../../../config/database.php";;
global $conn;
 
$conn = Database::getConnection(); 
include 'layout.php'; 
if (!isset($_GET["id_reservas"])) { 
header("Location: mis_reservas.php"); 
exit(); 
} 
$id_reservas = $_GET["id_reservas"]; // Es un array de reservas seleccionadas 
$ids = implode(",", array_map("intval", $id_reservas)); // Sanitiza los IDs 
$stmt = $conn->query("SELECT r.id_reserva, a.nombre, a.precio 
FROM Reservas r 
JOIN Actividades a ON r.id_actividad = a.id_actividad 
WHERE r.id_reserva IN ($ids)"); 
$reservas = $stmt->fetchAll(PDO::FETCH_ASSOC); 
$total = 0; 
foreach ($reservas as $reserva) { 
$total += $reserva['precio']; 
} 
?> 
<div class="container mt-5"> 
<h2 class="text-center">Pago de Reservas</h2> 
<ul> 
<?php foreach ($reservas as $reserva): ?> 
<li><?= htmlspecialchars($reserva['nombre']) ?> - $<?= number_format($reserva['precio'], 2) ?></li> 
<?php endforeach; ?> 
</ul> 
<p><strong>Total a Pagar:</strong> $<?= number_format($total, 2) ?></p> 
<form action="../controllers/PagoController.php" method="POST"> 
<?php foreach ($id_reservas as $id): ?> 
<input type="hidden" name="id_reservas[]" value="<?= $id ?>"> 
<?php endforeach; ?> 
<div class="mb-3"> 
<label class="form-label">Método de Pago</label> 
<select name="metodo_pago" class="form-control" required> 
<option value="Tarjeta de Crédito">Tarjeta de Crédito</option> 
<option value="PayPal">PayPal</option> 
<option value="Transferencia Bancaria">Transferencia Bancaria</option> 
</select> 
</div> 
<button type="submit" name="pagar" class="btn btn-success w-100">Realizar Pago</button> 
  </form> 
</div>
