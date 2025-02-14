<!DOCTYPE html>
<html lang="en">
<head>
    <!-- MetaDatos -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Título -->
    <title>Inicio de sesión</title>
</head>
<body>
    <div>
        <!-- Login inicio de sesión -->
        <form class="form__Login" action="formulario_inicio_sesion.php" method="post" aria-labelledby="login-form">
            <h1 class="form__title" id="login-form">Iniciar Sesión</h1>
            <!-- Campo de correo -->
            <div class="form__input">
                <label class="form__label" for="correo">
                    <input type="email" id="correo" name="correo" placeholder="Correo" required aria-label="Usuario" value="<?php echo isset($_POST['correo']) ? $_POST['correo'] : ''; ?>">
                    <ion-icon name="person-outline"></ion-icon>
                </label>
            </div>
            <!-- Campo de contraseña -->
            <div class="form__input">
                <label class="form__label" for="contraseña">
                    <input type="password" id="contraseña" name="contraseña" placeholder="Contraseña" required aria-label="Password">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                </label>
            </div>
            <!-- Botón inicio de sesión -->
            <div class="form__input">
                <input class="form__btn" type="submit" value="Entrar">
            </div>
            <!-- Enlace para registrarse -->
            <p class="form__link">
                ¿No tienes una cuenta?<a href="formulario_registro.php" aria-label="registrarse"> Regístrate</a>
            </p>
        </form>

        <!-- Mensajes de error -->
        <div class="form__errors" style="text-align: center;">
            <?php 
                include('conexion.php'); // Incluir archivo de conexión

                // Comprobar si el usuario ha enviado el formulario
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $errores = [];
                    if (empty($_POST['correo'])) {
                        $errores[] = 'Por favor, ingresa tu correo.';
                    }
                    if (empty($_POST['contraseña'])) {
                        $errores[] = 'Por favor, ingresa tu contraseña.';
                    }

                    if (empty($errores)) {
                        if (isset($_POST['correo']) && isset($_POST['contraseña'])) {
                            $correo = $conexion->real_escape_string($_POST['correo']);
                            $contraseña = $_POST['contraseña'];

                            // Consulta para verificar el correo
                            $consulta = $conexion->prepare("SELECT * FROM usuarios WHERE correo = ?");
                            $consulta->bind_param('s', $correo);
                            $consulta->execute();
                            $resultado = $consulta->get_result();

                            if ($resultado->num_rows > 0) {
                                $usuario = $resultado->fetch_assoc();

                                // Verificar la contraseña
                                if (password_verify($contraseña, $usuario['contraseña'])) {
                                    // Login exitoso
                                    setcookie('correo', $usuario['correo'], time() + 60*60*24*365, '/', '', true, true);
                                    setcookie('nombre', $usuario['nombre'], time() + 60*60*24*365, '/', '', true, true);
                                    header('Location: menu.php');
                                    exit;
                                } else {
                                    // Mostrar un mensaje de error si la contraseña es incorrecta
                                    echo "<p style='color: red;'>Contraseña incorrecta.</p>";
                                }
                            } else {
                                // Mostrar un mensaje de error si el correo no está registrado
                                echo "<p style='color: red;'>El correo ingresado no está registrado.</p>";
                            }
                        }
                    } else {
                        // Mostrar mensajes de error si faltan campos
                        foreach ($errores as $error) {
                            echo "<p style='color: red;'>$error</p>";
                        }
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>



