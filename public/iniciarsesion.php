<?php
// Iniciar la sesión
session_start();

// Obtener datos del formulario
$usuario = $_POST["txtUsuario"];
$clave = $_POST["txtClave"];

// Configuración de la base de datos
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "cobohubbd";

try {
    // Crear conexión
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare("CALL sp_validar_login(:usuarioU, :claveU);");
    $stmt->bindParam(':usuarioU', $usuario);
    $stmt->bindParam(':claveU', $clave);
    $stmt->execute();

    // Obtener los resultados
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $usuarioBD = $result['nomLogin'];
        $claveBD = $result['claveLogin'];

        if ($usuarioBD == $usuario && $claveBD == $clave) {
            // Usuario y clave correctos, iniciar sesión
            $_SESSION['usuarioValido'] = $usuarioBD;
            echo '<script>window.location.href="paginaAdmin.php";</script>';
            exit;
        } else {
            echo "Usuario o clave incorrectos.";
        }
    } else {
        echo "Usuario o clave incorrectos.";
    }

} catch (PDOException $e) {
    echo 'Error de sintaxis: ' . $e->getMessage();
}

// Cerrar conexión
$conn = null;
?>