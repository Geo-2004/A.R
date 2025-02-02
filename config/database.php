<?php
$host = "monorail.proxy.rlwy.net";
$dbname = "railway";
$username = "root";
$password = "bgBEHYeyMANIfNLxemFXuEVxJJvSIhaz";

try {
    $conn = new
     PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("SET NAMES 'utf8mb4'");
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
//mysql://root:bgBEHYeyMANIfNLxemFXuEVxJJvSIhaz@monorail.proxy.rlwy.net:56165/railway