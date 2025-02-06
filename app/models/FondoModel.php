<?php 
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once __DIR__ . "/../../config/database.php"; // Ruta corregida

class FondoModel { 
    private $conn; 

    public function __construct() { 
        $this->conn = Database::getConnection();
    } 

    public function obtenerFondo($tipoFondo) { 
        $stmt = $this->conn->prepare("SELECT imagen FROM fondo WHERE tipo = ?");
        $stmt->execute([$tipoFondo]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ?: ["imagen" => "default.jpg"]; // Retorna default si no hay imagen
    }

    public function actualizarFondo($nombreArchivo, $tipoFondo) { 
        $stmt = $this->conn->prepare("UPDATE fondo SET imagen = ? WHERE tipo = ?");
        $resultado = $stmt->execute([$nombreArchivo, $tipoFondo]); 
    
        if ($resultado) {
            echo "✅ Imagen actualizada en la base de datos correctamente.<br>";
        } else {
            echo "❌ Error al actualizar la base de datos.<br>";
            print_r($stmt->errorInfo()); // Muestra detalles del error SQL
        }
    
        return $resultado;
    }
    

    public function insertarFondoSiNoExiste() { 
        $stmt = $this->conn->query("SELECT COUNT(*) FROM fondo WHERE id = 1"); 
        $existe = $stmt->fetchColumn(); 

        if ($existe == 0) { 
            $stmt = $this->conn->prepare("INSERT INTO fondo (id, imagen) VALUES (1, 'default.jpg')"); 
            return $stmt->execute(); 
        } 
        return true; 
    } 
}
?>