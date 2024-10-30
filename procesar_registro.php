<?php
include('config/conexion.php');

// Verificar si se envió el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Encriptar la contraseña
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Verificar si el usuario ya existe
    $check_user = "SELECT id FROM usuarios WHERE nombre = '$username'";
    $result = mysqli_query($con, $check_user);

    if (mysqli_num_rows($result) > 0) {
        echo "Este nombre de usuario ya está registrado.";
    } else {
        // Insertar el nuevo usuario en la base de datos
        $query = "INSERT INTO usuarios (nombre, clave) VALUES ('$username', '$hashed_password')";
        if (mysqli_query($con, $query)) {
            echo "Registro exitoso. Ahora puedes iniciar sesión.";
            header("Location: login.php");
            exit;
        } else {
            echo "Error al registrar el usuario: " . mysqli_error($con);
        }
    }
}
?>
