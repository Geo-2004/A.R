<?php
$host = "localhost";
$dbname = "sistema_reservas";
$username = "root";
$password = "";

try {
    $conn = new
     PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("SET NAMES 'utf8mb4'");
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>