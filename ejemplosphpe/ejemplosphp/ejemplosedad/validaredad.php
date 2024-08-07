<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    <?php
     $nombre;
     $clave;
     $estatura;
     $nombre =$_GET['txtNombre'];
     $clave=$_GET['txtClave'];
     $estatura= $_GET['txtEstatura'];
 
     echo'<br>Nombre: '. $nombre;
     echo'<br>Edad: '. $clave;
     echo'<br>Estatura: '. $estatura;
 
     if ($edad>=18){
         echo '<br>eres mayor de edad';
     }else{
         echo'<br>eres menor de edad';
     }

    ?>
</body>
</html>