<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Concurso de Disfraces de Halloween</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <?php 
    include('config/conexion.php'); 
    session_start();
    ?>
    
    <nav>
        <ul>
            <li><a href="index.php">Ver disfraces</a></li>
            <li><a href="login.php">Iniciar sesión</a></li>
            <li><a href="registro.php">Registro</a></li>
            <li><a href="admin.php">Panel de administración</a></li>
        </ul>
    </nav>
    
    <header>
        <h1>Concurso de Disfraces de Halloween</h1>
    </header>
    
    <main>
        <!-- Sección de disfraces -->
        <section id="disfraces-list" class="section">
            <h2>Disfraces Participantes</h2>
            <?php
            // Consulta para obtener los disfraces activos (no eliminados) de la base de datos
            $consulta = "SELECT id, nombre, descripcion, votos, foto FROM disfraces WHERE eliminado = 0";
            $resultado = mysqli_query($con, $consulta);

            // Mostrar los disfraces
            while ($disfraz = mysqli_fetch_assoc($resultado)) {
                echo '<div class="disfraz">';
                echo '<h3>' . htmlspecialchars($disfraz['nombre']) . '</h3>';
                echo '<p>' . htmlspecialchars($disfraz['descripcion']) . '</p>';
                echo '<p><img src="imagenes/' . htmlspecialchars($disfraz['foto']) . '" alt="Disfraz de ' . htmlspecialchars($disfraz['nombre']) . '" width="100%"></p>';
                echo '<p>Votos: <span id="votos-' . $disfraz['id'] . '">' . $disfraz['votos'] . '</span></p>';
                
                // Verificar si el usuario ha iniciado sesión para permitir votar
                if (isset($_SESSION['user_id'])) {
                    echo '<button class="votar" data-id="' . $disfraz['id'] . '">Votar</button>';
                } else {
                    echo '<p>Inicia sesión para votar</p>';
                }
                
                echo '</div>';
                echo '<hr>';
            }
            ?>
        </section>
    </main>
    
    <!-- JavaScript para manejar la votación -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const votarButtons = document.querySelectorAll(".votar");

        votarButtons.forEach((button) => {
            button.addEventListener("click", () => {
                const disfrazId = button.getAttribute("data-id");

                fetch("votar_disfraz.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({ id: disfrazId }),
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert("¡Gracias por tu voto!");

                        // Actualizar el contador de votos en la interfaz
                        const votosElement = document.getElementById(`votos-${disfrazId}`);
                        if (votosElement) {
                            votosElement.textContent = data.votos;
                        }
                    } else {
                        alert(data.message || "Hubo un error al enviar tu voto. Inténtalo nuevamente.");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("No se pudo enviar el voto. Verifica tu conexión.");
                });
            });
        });
    });
    </script>
</body>
</html>
