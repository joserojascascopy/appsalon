<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

define('MAIL_HOST', $_ENV['MAIL_HOST']);
define('MAIL_USERNAME', $_ENV['MAIL_USERNAME']);
define('MAIL_PASSWORD', $_ENV['MAIL_PASSWORD']);
define('MAIL_PORT', $_ENV['MAIL_PORT']);

class Email {
    public $email;
    public $nombre;
    public $token;

    public function __construct($nombre, $email, $token) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        // Crear la instancia de PHPMailer
        $mail = new PHPMailer();

        // Server settings
        $mail->isSMTP();   
        $mail->Host = MAIL_HOST;
        $mail->SMTPAuth = true;
        $mail->Port = MAIL_PORT;
        $mail->Username = MAIL_USERNAME;
        $mail->Password = MAIL_PASSWORD;

        $mail->setFrom('admin@appsalon.com');
        $mail->addAddress('admin@appsalon.com', 'AppSalon.com');

        //Content
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Confirma tu cuenta';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola, " . $this->nombre . "</strong>. Has creado tu cuenta en AppSalon
        , solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/confirmar-cuenta?token=" . $this->token . "'>Confirmar cuenta</a></p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        // Enviar el email
        $resultado = $mail->send();

        debugger($resultado);
    }
}