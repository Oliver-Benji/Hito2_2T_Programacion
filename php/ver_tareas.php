<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Tareas</title>
    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php 
include_once('conexion.php'); // Incluir archivo de conexión

// Comprobar que se han creado las cookies de inicio de sesión
if(isset($_COOKIE['correo']) && isset($_COOKIE['nombre'])){
    echo "<form class='form_Login' aria-labelledby='login-form'>";

        echo "<h1 class='form_title'>Bienvenido ".$_COOKIE['nombre']."</h1>";
        echo "<h2 class='form_title'>Aquí se verán las tareas que tienes y sus especificaciones</h2>";
        
        // Consulta para obtener las tareas del usuario
        $consulta = $conexion->prepare("SELECT * FROM tareas WHERE correo = ?");
        $consulta->bind_param('s', $_COOKIE['correo']);
        $consulta->execute();
        $resultado = $consulta->get_result();
        
        // Mostrar las tareas en una tabla
        echo "<table border='1'>
                <tr>
                    <th>ID Tarea</th>
                    <th>Correo</th>
                    <th>Nombre Tarea</th>
                    <th>Descripción</th>
                    <th>Fecha Inicio</th>
                    <th>Estado</th>
                </tr>";
        while($tarea = $resultado->fetch_assoc()){
            echo "<tr>
                    <td>".$tarea['id_tarea']."</td>
                    <td>".$tarea['correo']."</td>
                    <td>".$tarea['nombre_tarea']."</td>
                    <td>".$tarea['descripcion']."</td>
                    <td>".$tarea['fecha_inicio']."</td>
                    <td>".$tarea['estado']."</td>
                </tr>";
        }
        echo "</table>";
        
        // Botón para volver al menú 
        echo "<a href='menu.php'>Volver</a>";
    echo "</form>";
} else {
    // Redirigir al formulario de inicio de sesión si no hay cookies
    header('Location: formulario_inicio_sesion.php');
}
?>
</body>
</html>
