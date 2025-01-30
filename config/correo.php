<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Cargar automáticamente las librerías

function enviarCorreo($destinatario, $asunto, $mensaje) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'rikimamallacta5@gmail.com'; // Reemplaza con tu correo
        $mail->Password = 'rgak ejny qeug bzij'; // Reemplaza con tu contraseña o app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('tuemail@gmail.com', 'Sistema de Reservas');
        $mail->addAddress($destinatario);
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body = $mensaje;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
}
}
?>