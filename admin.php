<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<nav>
        <ul>
            <li><a href="index.php">Ver disfraces</a></li>
            <li><a href="login.php">Iniciar sesión</a></li>
            <li><a href="registro.php">Registro</a></li>
            <li><a href="admin.php">Panel de administración</a></li>
        </ul>
    </nav>
    
    <header>
        <h1>Panel de Administración</h1>
    </header>
    
    <main>
        <section id="admin" class="section">
            <h2>Agregar Disfraz</h2>
            <form action="procesar_disfraz.php" method="POST" enctype="multipart/form-data">
                <label for="disfraz-nombre">Nombre del Disfraz:</label>
                <input type="text" id="disfraz-nombre" name="disfraz-nombre" required>
                
                <label for="disfraz-descripcion">Descripción del Disfraz:</label>
                <textarea id="disfraz-descripcion" name="disfraz-descripcion" required></textarea>
                
                <label for="disfraz-foto">Foto:</label>
                <input type="file" id="disfraz-foto" name="disfraz-foto" required>

                <button type="submit">Agregar Disfraz</button>
            </form>
        </section>
    </main>
</body>
</html>
