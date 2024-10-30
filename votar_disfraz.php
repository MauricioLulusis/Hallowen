<?php
include('config/conexion.php');
session_start();
header('Content-Type: application/json');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Debes iniciar sesión para votar.']);
    exit;
}

// Obtener el ID del usuario de la sesión
$user_id = $_SESSION['user_id'];

// Decodificar el JSON recibido desde `fetch` en script.js
$data = json_decode(file_get_contents("php://input"), true);
$disfraz_id = $data['id'] ?? null;

// Validar el ID del disfraz
if (!$disfraz_id) {
    echo json_encode(['success' => false, 'message' => 'ID de disfraz no válido.', 'debug' => $data]);
    exit;
}

// Insertar el voto en la tabla de votos y actualizar el conteo de votos del disfraz
$insertar_voto = "INSERT INTO votos (id_usuario, id_disfraz) VALUES ('$user_id', '$disfraz_id')";
$actualizar_votos = "UPDATE disfraces SET votos = votos + 1 WHERE id = '$disfraz_id'";

if (mysqli_query($con, $insertar_voto) && mysqli_query($con, $actualizar_votos)) {
    // Obtener el nuevo conteo de votos
    $consulta_votos_actualizados = "SELECT votos FROM disfraces WHERE id = '$disfraz_id'";
    $resultado_votos = mysqli_query($con, $consulta_votos_actualizados);
    $nuevo_conteo = mysqli_fetch_assoc($resultado_votos)['votos'];
    
    echo json_encode(['success' => true, 'votos' => $nuevo_conteo]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al registrar el voto.']);
}
?>
