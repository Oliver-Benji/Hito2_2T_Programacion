<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form class="form__Login" action="formulario_registro.php" method="POST" aria-labelledby="login-form">
        <h1 class="form__title" id="login-form">Registro</h1>
        <!-- Campo de correo -->
        <div class="form__input">
            <input type="email" name="correo" id="correo" placeholder="Correo" required aria-label="correo">
        </div>
        <!-- Campo de nombre -->
        <div class="form__input">
            <input type="text" name="nombre" id="nombre" placeholder="Nombre" required aria-label="Usuario">
        </div>
        <!-- Campo de apellido -->
        <div class="form__input">
            <input type="text" name="apellido" id="apellido" placeholder="Apellido" required aria-label="apellido">
        </div>
        <!-- Campo de contraseña -->
        <div class="form__input">
            <input type="password" name="contraseña" id="contraseña" placeholder="Contraseña" required aria-label="Password">
        </div>
        <!-- Botón de registrarse -->
        <div class="form__input">
            <input class="form__btn" type="submit" value="Registrarse" aria-label="registrarse">
        </div>
        <!-- Enlace para volver -->
        <p class="form__link">
            <a href='formulario_inicio_sesion.php'>Volver</a>
        </p>
        <?php 
            include('conexion.php'); // Incluir archivo de conexión

            // Comprobar conexión a la base de datos
            if ($conexion->connect_error) {
                echo "<div class='alert alert-danger'>Error al conectar a la base de datos</div>";
            } else {
                // Comprobar si se han enviado los datos
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $correo = $conexion->real_escape_string($_POST['correo']);
                    $nombre = $conexion->real_escape_string($_POST['nombre']);
                    $apellido = $conexion->real_escape_string($_POST['apellido']);
                    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

                    // Comprobar si el correo ya existe
                    $consulta_correo = "SELECT * FROM usuarios WHERE correo = ?";
                    $stmt = $conexion->prepare($consulta_correo);
                    $stmt->bind_param("s", $correo);
                    $stmt->execute();
                    $resultado = $stmt->get_result();
                    
                    if ($resultado->num_rows > 0) {
                        // Si el correo ya existe, mostrar un mensaje de error
                        echo "<div class='alert alert-danger'>El correo ya existe</div>";
                    } else {
                        // Insertar nuevo usuario en la base de datos
                        $consulta = "INSERT INTO usuarios (correo,contraseña, nombre, apellido ) VALUES (?, ?, ?, ?)";
                        $stmt = $conexion->prepare($consulta);
                        $stmt->bind_param("ssss", $correo, $contraseña, $nombre, $apellido );

                        if ($stmt->execute()) {
                            // Mostrar un mensaje de registro correcto
                            echo "<div class='alert alert-success'>Registro correcto</div>";
                        } else {
                            // Mostrar un mensaje de error al registrar
                            echo "<div class='alert alert-danger'>Error al registrar</div>";
                        }
                    }
                }
            }
        ?>
    </form>
</body>
</html>

