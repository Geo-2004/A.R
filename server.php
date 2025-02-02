<?php
$host = '0.0.0.0';  // Escucha en todas las interfaces
$port = getenv('PORT') ?: 3000;  // Usa el puerto de Railway o 3000 por defecto

echo "Servidor corriendo en http://$host:$port\n";

// Inicia el servidor PHP embebido
exec("php -S $host:$port -t views"); // Asegúrate de que 'public' es la carpeta correcta
?>
