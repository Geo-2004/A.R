<?php
require_once "../config/correo.php"; // Importamos la función de envío de correo
require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pagar"])) {
    $id_reservas = $_POST["id_reservas"]; 
    $metodo_pago = $_POST["metodo_pago"];

    try {
        $conn->beginTransaction();

        foreach ($id_reservas as $id_reserva) {
            $stmt = $conn->prepare("SELECT a.nombre, a.precio, u.email, u.nombre AS usuario_nombre 
                                    FROM Reservas r
                                    JOIN Actividades a ON r.id_actividad = a.id_actividad
                                    JOIN Usuarios u ON r.id_usuario = u.id_usuario
                                    WHERE r.id_reserva = ?");
            $stmt->execute([$id_reserva]);
            $reserva = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$reserva) {
                throw new Exception("Error: reserva no encontrada.");
            }

            $monto = $reserva["precio"];

            // Insertar pago
            $stmt = $conn->prepare("INSERT INTO Pagos (id_reserva, monto, metodo_pago) VALUES (?, ?, ?)");
            $stmt->execute([$id_reserva, $monto, $metodo_pago]);

            // Actualizar estado de la reserva
            $stmt = $conn->prepare("UPDATE Reservas SET estado = 'confirmada' WHERE id_reserva = ?");
            $stmt->execute([$id_reserva]);

            // Enviar correo de confirmación de pago
            $asunto = "Confirmacion de Pago";
            $mensaje = "<h2>Hola " . $reserva['usuario_nombre'] . ",</h2>";
            $mensaje .= "<p>Tu pago de <strong>$" . number_format($monto, 2) . "</strong> por la actividad <strong>" . $reserva['nombre'] . "</strong> ha sido confirmado.</p>";
            $mensaje .= "<p>Gracias por tu compra.</p>";

            enviarCorreo($reserva['email'], $asunto, $mensaje);
        }

        $conn->commit();
        header("Location: ../views/mis_reservas.php?mensaje=Pagos realizados. Revisa tu correo.");
    } catch (Exception $e) {
        $conn->rollBack();
        header("Location: ../views/mis_reservas.php?error=" . urlencode($e->getMessage()));
    }
}
?>