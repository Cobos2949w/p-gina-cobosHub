
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>
    <?php
   echo 'hola mundo..';
    ?> 
    <?php
    echo'<h2>eliud paredes reyes</h2>'
    ?>
    <?php
    $nombre;
    $edad;
    $estatura;
    $nombre ='eliud';
    $edad=19;
    $estatura= 1.74;

    echo'<br>Nombre: '. $nombre;
    echo'<br>Edad: '. $edad;
    echo'<br>Estatura: '. $estatura;

    if ($edad>=18){
        echo '<br>eres mayor de edad';
    }else{
        echo'<br>eres menor de edad';
    }

    ?>

    </h1>
</body>
</html>