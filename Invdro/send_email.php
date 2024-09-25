<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
    $mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : '';

    if (!empty($nombre) && !empty($correo) && !empty($mensaje)) {
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'anderson123cando@gmail.com'; // Tu correo de Gmail
            $mail->Password = 'scwl ghjy nuik jbvb'; // Usa la contraseña de aplicación generada
            $mail->SMTPSecure = 'tls'; // Usa 'ssl' si 'tls' no funciona
            $mail->Port = 587; // Usa 465 si 'ssl' es usado

            // Opcional: Deshabilitar verificación de certificado SSL
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->setFrom('anderson123cando@gmail.com', 'Tu Nombre');
            $mail->addAddress('anderson123cando@gmail.com');
            $mail->isHTML(false);
            $mail->Subject = "Nuevo mensaje de $nombre";
            $mail->Body    = "Nombre: $nombre\nCorreo: $correo\nMensaje:\n$mensaje";

            $mail->send();
            echo 'Mensaje enviado con éxito.';
        } catch (Exception $e) {
            echo "Error al enviar el mensaje. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
}
?>
