

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre     = $_POST['nombre'] ?? '';
    $email      = $_POST['email'] ?? '';
    $mensaje   = $_POST['mensaje'] ?? '';    

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';     
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@lombardia.com.ar';
        $mail->Password   = 'Lombardia2025!';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('info@lombardia.com.ar', 'Formulario Web');
        $mail->addAddress('info@lombardia.com.ar');
        

        $mail->isHTML(true);
        $mail->Subject = 'Nuevo mensaje desde lombardia.com.ar';
        $mail->Body    = "
            <h3>Nuevo contacto desde la web</h3>
            <p><b>Nombre:</b> {$nombre}</p>
            <p><b>Email:</b> {$email}</p>
            <p><b>Telefono:</b> {$mensaje}</p>           
        ";

        $mail->send();
        echo json_encode(["success" => true]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "error" => $mail->ErrorInfo]);
    }
}





