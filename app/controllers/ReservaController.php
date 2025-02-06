ReservaController: <?php 
require_once __DIR__ . "/../../config/correo.php";; // Importamos la función de envío de correo 
require_once __DIR__ . "/../../config/database.php";; 

session_start(); 
global $conn;
 
$conn = Database::getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["reservar"])) { 
$id_usuario = $_SESSION["usuario_id"]; 
$id_actividad = $_POST["id_actividad"]; 
$stmt =$conn->prepare("INSERT INTO Reservas (id_usuario, id_actividad) VALUES (?, ?)"); 
if ($stmt->execute([$id_usuario, $id_actividad])) { 
// Obtener correo y nombre del usuario 
$stmt = $conn->prepare("SELECT email, nombre FROM Usuarios WHERE id_usuario = ?"); 
$stmt->execute([$id_usuario]); 
$usuario = $stmt->fetch(PDO::FETCH_ASSOC); 
// Obtener detalles de la actividad 
$stmt = $conn->prepare("SELECT nombre, precio FROM Actividades WHERE id_actividad = ?"); 
$stmt->execute([$id_actividad]); 
$actividad = $stmt->fetch(PDO::FETCH_ASSOC); 
// Enviar correo de confirmación 
$asunto = "Confirmacion de Reserva"; 
$mensaje = "<h2>Hola " . $usuario['nombre'] . ",</h2>"; 
$mensaje .= "<p>Has reservado la actividad <strong>" . $actividad['nombre'] . "</strong> por $" . number_format($actividad['precio'], 2) . ".</p>"; 
$mensaje .= "<p>Gracias por usar nuestro servicio.</p>"; 
enviarCorreo($usuario['email'], $asunto, $mensaje); 
header("Location: ../views/mis_reservas.php?mensaje=Reserva confirmada. Revisa tu correo."); 
} else { 
header("Location: ../reservar.php?error=No se pudo realizar la reserva"); 
} 
} 
?>
