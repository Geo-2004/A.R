<?php
require_once __DIR__ . "/app/controllers/FondoController.php"; // Ruta corregida
$controlador = new FondoController();

// Obtener imágenes de fondo por tipo
$fondoInicio = $controlador->obtenerFondo("inicio")["imagen"];
$fondoLogin = $controlador->obtenerFondo("login")["imagen"];
$fondoDashboard = $controlador->obtenerFondo("dashboard")["imagen"];

// Construir rutas de imagen
$rutaFondoInicio = "/proyecto_final/uploads/" . ($fondoInicio ?? 'default.jpg');  // Corregido
$rutaFondoLogin = "/proyecto_final/uploads/" . ($fondoLogin ?? 'default.jpg');    // Corregido
$rutaFondoDashboard ="/proyecto_final/uploads/" . ($fondoDashboard ?? 'default.jpg'); // Corregido
?>