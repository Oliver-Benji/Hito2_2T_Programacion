<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrar sesión</title>
    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    // Incluir archivo de conexión
    include('conexion.php');
    
    // Eliminar cookies
    setcookie('correo', '', time() - 60*60*24*365, '/');
    setcookie('nombre', '', time() - 60*60*24*365, '/');
    
    // Destruir la sesión
    session_start();
    session_unset();
    session_destroy();
    
    // Mostrar mensaje de sesión cerrada correctamente
    echo "<div>
        <!-- Login inicio de sesión -->
        <form class='form__Login' aria-labelledby='login-form'>
            <h1 class='form__title' id='login-form'>Sesión cerrada correctamente</h1>
            <p class='form__link'>
                <a href='formulario_inicio_sesion.php' aria-label='registrarse'> Volver</a>
            </p>
        </form>
    </div>";
    ?>
</body>
</html>