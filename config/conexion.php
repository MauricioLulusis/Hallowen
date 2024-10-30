<?php
$host = "localhost"; // Cambia esto si tu servidor es diferente
$usuario = "root"; // Usuario de la base de datos
$password = ""; // Contraseña de la base de datos
$base_datos = "hallowen"; // Nombre de la base de datos

// Crear conexión
$con = mysqli_connect($host, $usuario, $password, $base_datos);

// Verificar la conexión
if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
