<?php 
require_once __DIR__ . "/../models/FondoModel.php"; // Ruta corregida

class FondoController { 
    private $modelo; 

    public function __construct() { 
        $this->modelo = new FondoModel(); 
        $this->modelo->insertarFondoSiNoExiste(); // Asegurar que haya un registro en la tabla 
    } 

    public function obtenerFondo($tipoFondo) { 
        return $this->modelo->obtenerFondo($tipoFondo); 
    } 

    public function actualizarFondo() { 
        session_start(); 
    
        // Verificar si el usuario es administrador
        if (!isset($_SESSION["usuario_id"]) || $_SESSION["tipo_usuario"] !== "administrador") {
            header("Location: ../views/admin_panel.php?error=No tienes permisos para cambiar el fondo");
            exit();
        }
    
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["imagen"]) && isset($_POST["tipo_fondo"])) { 
            $tipoFondo = $_POST["tipo_fondo"]; 
    
            // 🔹 Mensaje de depuración para verificar si tipo_fondo está llegando bien
            echo "Tipo de fondo recibido: " . $_POST["tipo_fondo"] . "<br>";
    
            $archivo = $_FILES["imagen"]; 
            $nombreArchivo = time() . "_" . basename($archivo["name"]); 
            $rutaDestino = realpath(__DIR__ . "/../../uploads") . "/" . $nombreArchivo; 
    
            // Verificar si el archivo es una imagen 
            $permitidos = ['image/jpeg', 'image/png', 'image/jpg']; 
            if (!in_array($archivo["type"], $permitidos)) { 
                header("Location: ../views/admin_panel.php?error=Solo se permiten imágenes JPG y PNG");
                exit();
            } 
    
            // Intentar mover el archivo al directorio uploads 
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaDestino)) { 
                echo "Imagen subida correctamente a la carpeta.<br>";
    
                if ($this->modelo->actualizarFondo($nombreArchivo, $tipoFondo)) {
                    die("Imagen guardada en la base de datos con éxito.");
                } else {
                    die("Error al guardar en la base de datos.");
                }
            } else { 
                die("Error al mover la imagen a la carpeta.");
       }
    }
}
}
// Si se envía un formulario con el botón "subir", ejecutar la función actualizarFondo()
if (isset($_POST["subir"])) { 
    $controlador = new FondoController(); 
    $controlador->actualizarFondo();
}
?>