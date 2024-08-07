<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Asegúrate de que estas rutas son correctas
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emailUsuario = $_POST['emailUsuario'];

    // Configuración de la base de datos
    $servername = "localhost:3307"; // Ajusta el puerto si es necesario
    $username = "root";
    $password = "";
    $dbname = "cobohubbd";

    try {
        // Conectar a la base de datos
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparar y ejecutar la consulta almacenada
        $stmt = $conn->prepare("CALL cobohubbd.sp_recuperarcontraseña(:_emailUsuario)");
        $stmt->bindParam(':_emailUsuario', $emailUsuario);
        $stmt->execute();

        // Obtener la contraseña recuperada
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $claveLogin = $result['claveLogin'];

            // Configurar PHPMailer
            $mail = new PHPMailer(true);
            try {
                // Configuración del servidor SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = '23300013@uttt.edu.mx'; // Tu correo de Gmail
                $mail->Password = 'gcuc qrfu jjaa yves'; // La contraseña de aplicación generada
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Destinatarios
                $mail->setFrom('no-reply@tusitio.com', 'CoboStore');
                $mail->addAddress($emailUsuario);

                // Contenido del correo
                $mail->isHTML(true);
                $mail->Subject = 'Recuperación de contraseña';
                $mail->Body    = 'Tu contraseña de recuperación es: ' . $claveLogin;

                // Enviar el correo
                $mail->send();
                echo 'Se ha enviado un correo electrónico con tu contraseña de recuperación.';
            } catch (Exception $e) {
                echo "Error al enviar el correo electrónico. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "No se encontró una cuenta con ese correo electrónico.";
        }

    } catch (PDOException $e) {
        echo 'Error de base de datos: ' . $e->getMessage();
    }

    $conn = null;
}
?>