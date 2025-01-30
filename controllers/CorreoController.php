<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Asegúrate de que PHPMailer esté instalado
require_once 'config/correo.php';

class CorreoController {
    private $correo;

    public function __construct() {
        $config = require 'config/correo.php';
        
        $this->correo = new PHPMailer(true);
        try {
            // Configuración del servidor SMTP
            $this->correo->isSMTP();
            $this->correo->Host = $config['host'];
            $this->correo->SMTPAuth = true;
            $this->correo->Username = $config['username'];
            $this->correo->Password = $config['password'];
            $this->correo->SMTPSecure = $config['encryption'];
            $this->correo->Port = $config['port'];

            // Configuración del remitente
            $this->correo->setFrom($config['from_correo'], $config['from_name']);
            $this->correo->isHTML(true);
        } catch (Exception $e) {
            die("Error al configurar PHPMailer: " . $e->getMessage());
        }
    }

    public function enviarCorreo($destinatario, $asunto, $mensaje) {
        try {
            $this->correo->addAddress($destinatario);
            $this->correo->Subject = $asunto;
            $this->correo->Body = $mensaje;

            $this->correo->send();
            return true;
        } catch (Exception $e) {
            return "Error al enviar el correo: " . $this->correo->ErrorInfo;
    }
}
}
?>