<?php

require_once 'config/config.php'; // Ajustamos la ruta de config.php

$controller = 'Login'; // Controlador por defecto
$method = 'index'; // Método por defecto
$params = [];

if (isset($_GET['url'])) {
    $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));

    if (!empty($url[0])) {
        $controller = ucfirst($url[0]) . 'Controller';
    }

    if (!empty($url[1])) {
        $method = $url[1];
    }

    $params = array_slice($url, 2);
}

// Ruta al controlador
$controllerPath = "app/controllers/$controller.php";

if (file_exists($controllerPath)) {
    require_once $controllerPath;
    $controller = new $controller();

    if (method_exists($controller, $method)) {
        call_user_func_array([$controller, $method], $params);
    } else {
        echo "Error: Método '$method' no encontrado en el controlador '$controller'.";
    }
} else {
    echo "Error: Controlador '$controller' no encontrado.";
}