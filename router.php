<?php

    // Incluir configuración de la base de datos
    require_once 'config/database.php';
    
    // Obtener la URL de la solicitud
    $request = trim($_SERVER['REQUEST_URI'], '/');
    
    // Si la URL está vacía, redirigir a "inicio"
    if ($request === '') {
        $request = 'inicio';
    }
    
    // Definir rutas y requerir los archivos correctos
    switch ($request) {
        case 'inicio':
            require 'app/views/Inicio.php';
            break;
    
        case 'login':
            require 'app/controllers/LoginController.php';
            break;
    
        case 'logout':
            require 'app/controllers/LogoutController.php';
            break;
    
        case 'usuarios':
            require 'app/controllers/UsuariosController.php';
            break;
    
        case 'reservas':
            require 'app/controllers/ReservasController.php';
            break;
    
        case 'actividades':
            require 'app/controllers/ActividadesController.php';
            break;
    
        default:
            http_response_code(404);
            echo "Página no encontrada";
            break;
    }
    ?>