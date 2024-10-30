<?php
include('config/conexion.php');
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Debes iniciar sesión para votar.']);
    exit;
}

$user_id = $_SESSION['user_id'];
$disfraz_id = $_POST['disfraz_id'];

// Verificar si el usuario ya ha votado por este disfraz
$consulta_voto = "SELECT id FROM votos WHERE id_usuario = '$user_id' AND id_disfraz = '$disfraz_id'";
$resultado_voto = mysqli_query($con, $consulta_voto);

if (mysqli_num_rows($resultado_voto) > 0) {
    echo json_encode(['success' => false, 'message' => 'Ya has votado por este disfraz.']);
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
    
    echo json_encode(['success' => true, 'message' => '¡Gracias por tu voto!', 'votos' => $nuevo_conteo]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al registrar el voto.']);
}
?>
