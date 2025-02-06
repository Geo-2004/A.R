<?php 
include 'layout.php'; 
require_once __DIR__ . '/../../background.php'; // Incluir fondo desde la raíz
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Ahuanoruna</title>
    <style>
        body {
            background: url('<?= $rutaFondoInicio ?>') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            color: white;
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        .content {
            background: rgba(0, 0, 0, 0.6);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            max-width: 450px;
            width: 90%;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .button-container {
            list-style: none;
            padding: 0;
        }

        .nav-item {
            margin-bottom: 15px;
        }

        .nav-link {
            display: block;
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 12px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background: linear-gradient(135deg, #0056b3, #003a75);
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<div class="content">
    <h1>AHUANORUNA</h1>
    <p>BIENVENIDO.</p>
    <ul class="button-container">
        <li class="nav-item"><a class="nav-link" href="login.php">Iniciar Sesión</a></li>
        <li class="nav-item"><a class="nav-link" href="registro.php">Registrarse</a></li>
    </ul>
</div>

</body>