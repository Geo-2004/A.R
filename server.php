<?php
$host = '0.0.0.0'; 
$port = getenv('PORT') ?: 8080; // Usa el puerto de Railway o 3000 por defecto

echo "Servidor corriendo en http://$host:$port\n";
exec("php -S $host:$port -t public"); // Cambia 'public' si tu index.php está en otra carpeta
?>
