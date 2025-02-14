<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
    include 'conexion.php'; // Incluir archivo de conexión

    // Comprobar si las cookies están establecidas
    if(isset($_COOKIE['correo']) && isset($_COOKIE['nombre'])){
        $correo = $_COOKIE['correo'];
        $nombre = $_COOKIE['nombre'];
    } else {
        // Mostrar un mensaje de error si no se han establecido las cookies
        echo "No se ha podido iniciar sesión";
        exit;
    }
?>
<div>
    <!-- Menu de navegación -->
    <form class="form__Login" aria-labelledby="login-form">
        <h1 class="form__title" id="login-form">Bienvenido al menú de navegación, <?php echo htmlspecialchars($nombre); ?></h1>
        <!-- Enlaces -->
        <ul class="form__link">
            <li><a href="ver_tareas.php" aria-label="ver tareas">Ver tareas</a></li>
            <li><a href="añadirTareas.php" aria-label="añadir tareas">Añadir tareas</a></li>
            <li><a href="CerrarSesion.php" aria-label="cerrar sesión">Cerrar sesión</a></li>
        </ul>
    </form>
</div>
</body>
</html>