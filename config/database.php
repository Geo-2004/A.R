<?php
// URL de conexión proporcionada por Railway
$db_url = "mysql://root:fytUMsACDqOwEwVoVFzUaHIMgClrqNyO@autorack.proxy.rlwy.net:43443/railway";

// Parsear la URL para obtener los componentes de la base de datos
$parsed_url = parse_url($db_url);

// Obtener los detalles de la conexión
$host = $parsed_url['host'];
$username = $parsed_url['user'];
$password = $parsed_url['pass'];
$dbname = ltrim($parsed_url['path'], "/");
$port = $parsed_url['port'];

try {
    // Conexión a la base de datos con PDO
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("SET NAMES 'utf8mb4'");
    echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
