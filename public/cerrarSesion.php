<?php
session_start();
session_unset();
session_destroy();
header("Location: public/index.html"); // Asegúrate de que la ruta al index principal sea correcta
exit();
?>