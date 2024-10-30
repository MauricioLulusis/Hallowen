<?php
include('config/conexion.php');
session_start();

// Verificar si se envió el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($con, $_POST['login-username']);
    $password = mysqli_real_escape_string($con, $_POST['login-password']);

    // Buscar al usuario en la base de datos
    $query = "SELECT id, clave FROM usuarios WHERE nombre = '$username'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        
        // Verificar la contraseña
        if (password_verify($password, $user['clave'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            echo "Inicio de sesión exitoso.";
            header("Location: index.php");
            exit;
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}
?>
