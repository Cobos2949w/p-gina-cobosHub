<?php
//recibir los datos del formulario de crear cuenta
//$nombreUsuario= $_POST['txtNombreUsuario'];
//$apPaternoUsuario= $_POST['txtNombreUsuario'];
//$apMaternoUsuario= $_POST['txtNombreUsuario'];
//$emailUsuario= $_POST['txtNombreUsuario'];
//$telUsuario= $_POST['txtNombreUsuario'];
//$fotoUsuario= addslashes(file_get_contents($_FILES['txtFoto']["tmp_name"]));
//$nombreLogin= $_POST['txtNombreUsuario'];
//$claveLogin= $_POST['txtNombreUsuario'];
//$idRolUsuario= $_POST['txtNombreUsuario'];

//Prueba
$nombreUsuario= "Emanuel";
$apPaternoUsuario= "Cruz";
$apMaternoUsuario= "C";
$emailUsuario= "2330003@uttt.edu.mx";
$telUsuario= "729756655";
$fotoUsuario= null;
$nombreLogin= "Emanuel";
$claveLogin= "2345";
$idRolUsuario=2;


$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "cobohubbd";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $conn->prepare("call cobohubbd.sp_crearCuenta(
:_nombreUsuasrio,
:_apPaternoUsuari,
:_apMaternoUsuario,
:_emailUsuario,
:_telUsuario,
:_fotoUsuario,
:_nombreLogin,
:_claveLogin,
:_idRolUsuario)");
  $stmt->bindParam(':_nombreUsuasrio', $nombreUsuario);
  $stmt->bindParam(':_apPaternoUsuari', $apPaternoUsuario);
  $stmt->bindParam(':_apMaternoUsuario', $apMaternoUsuario);
  $stmt->bindParam(':_emailUsuario', $emailUsuario);
  $stmt->bindParam(':_telUsuario', $telUsuario);
  $stmt->bindParam(':_fotoUsuario', $fotoUsuario);
  $stmt->bindParam(':_nombreLogin', $nombreLogin);
  $stmt->bindParam(':_claveLogin', $claveLogin);
  $stmt->bindParam(':_idRolUsuario', $idRolUsuario);

  $stmt->execute();
 
  echo 'se guardo con exito';


}catch  (PDOException $e){
  echo ' error de sintaxis '. $e->getMessage();
}
$cont=null;
?>