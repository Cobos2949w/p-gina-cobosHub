<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Asegúrate de que estas rutas son correctas
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emailUsuario = $_POST['emailUsuario'];

    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "cobohubbd";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("CALL cobohubbd.sp_recuperarcontraseña(:_emailUsuario)");
        $stmt->bindParam(':_emailUsuario', $emailUsuario);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $claveLogin = $result['claveLogin'];

            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = '23300013@uttt.edu.mx'; // Tu correo de Gmail
                $mail->Password = 'gcuc qrfu jjaa yves'; // La contraseña de aplicación generada
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // O PHPMailer::ENCRYPTION_SMTPS para SSL
                $mail->Port = 587; // O 465 si usas SSL

                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                $mail->setFrom('no-reply@tusitio.com', 'CoboStore');
                $mail->addAddress($emailUsuario);

                $mail->isHTML(true);
                $mail->Subject = 'Recuperación de contraseña';
                $mail->Body    = 'Tu contraseña de recuperación es: ' . $claveLogin;

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
<a href="../public/iniciarsesion.html">Regresar</a>