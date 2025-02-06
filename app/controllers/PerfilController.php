<?php 
require_once __DIR__ . "/../../config/database.php"; 

session_start(); 

$conn = Database::getConnection(); 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["actualizar"])) { 
    $id_usuario = $_POST["id_usuario"]; 
    $biografia = $_POST["biografia"] ?? ''; 

    $foto = null; 

    // Manejo de la imagen
    if (!empty($_FILES["foto"]["name"])) { 
        $foto_nombre = time() . "_" . basename($_FILES["foto"]["name"]); 
        $foto_ruta = __DIR__ . "/../../uploads/" . $foto_nombre; 

        // Verificar si es una imagen válida
        $permitidos = ['image/jpeg', 'image/png', 'image/jpg']; 
        if (!in_array($_FILES["foto"]["type"], $permitidos)) { 
            die("Error: Solo se permiten imágenes JPG y PNG.");
        } 

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $foto_ruta)) { 
            $foto = $foto_nombre; 
        } else {
            die("Error al mover la imagen.");
        }
    } 

    // Verificar si ya existe un perfil
    $stmt = $conn->prepare("SELECT * FROM Perfiles WHERE id_usuario = ?"); 
    $stmt->execute([$id_usuario]); 
    $perfil = $stmt->fetch(PDO::FETCH_ASSOC); 

    if ($perfil) { 
        // Si hay imagen nueva, actualiza también la foto
        if ($foto) { 
            $stmt = $conn->prepare("UPDATE Perfiles SET foto = ?, biografia = ? WHERE id_usuario = ?"); 
            $stmt->execute([$foto, $biografia, $id_usuario]); 
        } else { 
            $stmt = $conn->prepare("UPDATE Perfiles SET biografia = ? WHERE id_usuario = ?"); 
            $stmt->execute([$biografia, $id_usuario]); 
        } 
    } else { 
        // Insertar nuevo perfil
        $stmt = $conn->prepare("INSERT INTO Perfiles (id_usuario, foto, biografia) VALUES (?, ?, ?)"); 
        $stmt->execute([$id_usuario, $foto, $biografia]); 
    } 

    header("Location: ../views/perfil.php?mensaje=Perfil actualizado con éxito"); 
    exit();
} 
?>