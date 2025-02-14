<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Tareas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div>
    <!-- Formulario para añadir tareas -->
    <form class="form__Login" action="añadirTareas.php" method="post" aria-labelledby="login-form">
        <h1 class="form__title" id="login-form">Bienvenido</h1>
        <h1 class="form__title">Aquí podrás añadir tareas</h1>
        <!-- Campo de nombre tarea -->
        <div class="form__input">
            <input type="text" id="nombre_tarea" name="nombre_tarea" placeholder="Nombre de la tarea" required>
        </div>
        <!-- Campo de descripción -->
        <div class="form__input">
            <input type="text" id="descripcion" name="descripcion" placeholder="Descripción" required>
        </div>
        <!-- Campo de fecha inicio -->
        <div class="form__input">
            <input type="date" id="fecha_inicio" name="fecha_inicio" required>
        </div>
        <!-- Campo de estado -->
        <div class="form__input">
            <select name="estado" id="estado" required>
                <option value="">---Elije una opción---</option>
                <option value="pendiente">Pendiente</option>
                <option value="en proceso">En proceso</option>
                <option value="terminada">Terminada</option>
            </select>
        </div>
        <!-- Botón de añadir -->
        <div class="form__input">
            <input class="form__btn" type="submit" value="Añadir">
        </div>
        <!-- Enlace para volver -->
        <p class="form__link">
            <a href="menu.php">Volver</a>
        </p>
        <?php 
            include 'conexion.php'; // Incluir archivo de conexión

            // Comprobar si las cookies están establecidas
            if(isset($_COOKIE['correo']) && isset($_COOKIE['nombre'])){
                $correo = $_COOKIE['correo'];
                $nombre = $_COOKIE['nombre'];
                // Comprobar si se han enviado los datos
                if(!empty($_POST['nombre_tarea']) && !empty($_POST['descripcion']) && !empty($_POST['fecha_inicio']) && !empty($_POST['estado'])){
                    $nombre_tarea = $conexion->real_escape_string($_POST['nombre_tarea']);
                    $descripcion = $conexion->real_escape_string($_POST['descripcion']);
                    $fecha_inicio = $conexion->real_escape_string($_POST['fecha_inicio']);
                    $estado = $conexion->real_escape_string($_POST['estado']);
                    // Insertar nueva tarea en la base de datos
                    $consulta = "INSERT INTO tareas (correo, nombre_tarea, descripcion, fecha_inicio, estado) VALUES ('$correo', '$nombre_tarea', '$descripcion', '$fecha_inicio', '$estado')";
                    if (mysqli_query($conexion, $consulta)) {
                        // Mostrar un mensaje de tarea añadida correctamente
                        echo "<div class='alert alert-success'>Tarea añadida correctamente</div>";
                    } else {
                        // Mostrar un mensaje de error al añadir la tarea
                        echo "<div class='alert alert-danger'>Error al añadir la tarea: " . mysqli_error($conexion) . "</div>";
                    }
                } else {
                    // Mostrar un mensaje de error si faltan campos
                    echo "<div class='alert alert-danger'>Todos los campos son obligatorios</div>";
                }
            }
        ?>
    </form>
</div>
</body>
</html>