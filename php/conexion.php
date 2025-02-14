<?php 
// Conectar a la base de datos
$conexion = mysqli_connect('localhost', 'root', 'campusfp', 'clientes');

// Comprobar la conexión
if (!$conexion) {
    // Si la conexión falla, mostrar un mensaje de error y detener la ejecución
    die('Error al conectar a la base de datos');
}
?>