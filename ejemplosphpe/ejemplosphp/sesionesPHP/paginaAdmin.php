
<?php
session_start();
// con esta secion conecta seciones como si heredara de otra clase o algo asi
if (isset($_SESSION['usuarioValido'])) {
    
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoboStore</title>
    <script>
        document.addEventListener('DOMContentLoaded',()=>{
            const username = localStorage.getItem('username');
            const loginSection = document.getElementById('login-section');
            const welcomeSection = document.getElementById('welcome-section');
            const welcomeMessage = document.getElementById('welcome-message');
            
            if (username) {
                loginSection.style.display = 'none';
                welcomeMessage.textContent = `Bienvenido, ${username}`;
                welcomeSection.style.display = 'block';
            } else {
                loginSection.style.display = 'block';
                welcomeSection.style.display = 'none';
            }
        });
        function login() {
            const username = document.getElementById('username').value;
            if (username) {
                localStorage.setItem('username', username);
                window.location.reload();
            } else {
                alert('Por favor, ingresa un nombre de usuario.');
            }
        }

        function logout() {
            localStorage.removeItem('username');
            window.location.reload();
        }
    </script>
</head>
<body>
   <div class="container-fluid" id="contenedorPrincipal"> 
    <header>
        <div class="row">
            <div class="col-sm-4 mt-4">
                <h1>CoboStore</h1>
            </div>
             <div class="col-sm-6 mt-4">
                <div class="input-group">
                    <button class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown">
                        Categorias
                     </button>

                     <ul class="dropdown-menu">
                        <li><a href="../public/telefoniia.html" class="dropdown-item">Telefonia</a></li>
                        <li><a href="../public/hogar.html" class="dropdown-item">Hogar</a></li>
                        <li class="dropdown-item">Licores</li>
                        <li class="dropdown-item">Videojuegos</li>
                    </ul>
                   
                <li><a href="../public/promociones.html">Promociones</a></li>
            <li><a href="../public/masvendido.html">Lo más vendido</a></li>
            <li id="perfil"><a href="../public/perfil.html">Perfil</a></li>
        </ul>
    </nav>
    <nav>
        <p></p>
    </nav>
    
    
    <div id="login-section">
        <input type="text" id="username" placeholder="Usuario">
        <button onclick="login()">Iniciar Sesión</button>
    </div>
    <div id="welcome-section" style="display:none;">
        <p id="welcome-message"></p>
        <button onclick="logout()">Cerrar Sesión</button>
    </div>
</div> 
</body>
</html><?php
}// termina el if
else{
    echo 'debes iniciar sesion <br>';
    echo ' <a href="formularioedad2.html"> login </a>';
}
?>
