<?php
// iniciar la secion 
session_start();




$usuario=$_POST["txtUsuario"];
$clave=$_POST["txtClave"];
// consultar a la base de datos a l usuario y la cintaseña


$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "cobohubbd";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $conn->prepare("call cobohubbd.sp_validar_login(:usuarioU,:claveU);");
  $stmt->bindParam(':usuarioU', $usuario);
  $stmt->bindParam(':claveU', $clave);
  $stmt->execute();
  $result=$stmt ->setFetchMode(PDO::FETCH_ASSOC);
  $result=$stmt -> fetchAll();

  $usuarioBD= $result[0]['nombreLogin'];
  $claveBD= $result[0]['claveLogin'];

  echo " usuario: " .$usuarioBD;
  echo " clave: " .$claveBD;
  

}catch  (PDOException $e){
    echo ' error de sintaxis '. $e->getMessage();
}
$cont=null;


  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);


if ($usuarioBD==$usuario && $claveBD == $clave) {
    echo " clave o usuario correcto ";
    // agegar el nombre de usuario a la bariableglobal de secion 
    $_SESSION['usuarioValido']=$usuarioBD;

   echo'
   <script>
   window.location.href="paginaAdmin.php";
   </script>
   ';

}else{
    echo" usuario y clave incorecto ";

}
?>