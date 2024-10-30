<?php
include('config/conexion.php');

// Verificar si se envió el formulario para agregar un disfraz
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['disfraz-foto'])) {
    $nombre = mysqli_real_escape_string($con, $_POST['disfraz-nombre']);
    $descripcion = mysqli_real_escape_string($con, $_POST['disfraz-descripcion']);
    $foto_nombre = $_FILES['disfraz-foto']['name'];
    $foto_temporal = $_FILES['disfraz-foto']['tmp_name'];

    // Mover la foto subida a la carpeta de imágenes
    $foto_destino = "imagenes/" . $foto_nombre;
    if (move_uploaded_file($foto_temporal, $foto_destino)) {
        // Insertar el disfraz en la base de datos
        $query = "INSERT INTO disfraces (nombre, descripcion, votos, foto, eliminado) VALUES ('$nombre', '$descripcion', 0, '$foto_nombre', 0)";
        if (mysqli_query($con, $query)) {
            echo "Disfraz agregado exitosamente.";
            header("Location: admin.php");
            exit;
        } else {
            echo "Error al agregar el disfraz: " . mysqli_error($con);
        }
    } else {
        echo "Error al subir la foto.";
    }
}
?>
