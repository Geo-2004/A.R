<?php 
require_once __DIR__ . "/../../config/database.php";
global $conn;
 
$conn = Database::getConnection();
session_start(); 
if (!isset($_SESSION["usuario_id"]) || $_SESSION["tipo_usuario"] !== "administrador") { 
header("Location: ../views/dashboard.php"); 
exit(); 
} 
// Agregar nueva actividad 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["agregar"])) { 
$nombre = $_POST["nombre"]; 
$descripcion = $_POST["descripcion"]; 
$precio = $_POST["precio"]; 
$ubicacion = $_POST["ubicacion"]; 
$stmt = $conn->prepare("INSERT INTO Actividades (nombre, descripcion, precio, ubicacion) VALUES (?, ?, ?, ?)"); 
if ($stmt->execute([$nombre, $descripcion, $precio, $ubicacion])) { 
header("Location: ../views/gestionar_actividades.php?mensaje=Actividad agregada con éxito"); 
} else { 
header("Location: ../views/agregar_actividad.php?error=No se pudo agregar la actividad"); 
} 
} 
// Eliminar actividad 
if (isset($_GET["eliminar"])) { 
$id_actividad = $_GET["eliminar"]; 
$stmt = $conn->prepare("DELETE FROM Actividades WHERE id_actividad = ?"); 
if ($stmt->execute([$id_actividad])) { 
header("Location: ../views/gestionar_actividades.php?mensaje=Actividad eliminada con éxito"); 
} else { 
header("Location: ../views/gestionar_actividades.php?error=No se pudo eliminar la actividad"); 
} 
} 
?> 
