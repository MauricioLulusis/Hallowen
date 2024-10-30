<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Ver Disfraces</a></li>
            <li><a href="registro.php">Registro</a></li>
            <li><a href="login.php">Iniciar Sesión</a></li>
            <li><a href="admin.php">Panel de Administración</a></li>
        </ul>
    </nav>
    
    <header>
        <h1>Registro de Usuario</h1>
    </header>
    
    <main>
        <section id="registro" class="section">
            <h2>Registro</h2>
            <form action="procesar_registro.php" method="POST">
                <label for="username">Nombre de Usuario:</label>
                <input type="text" id="username" name="username" required>
                
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                
                <button type="submit">Registrarse</button>
            </form>
        </section>
    </main>
</body>
</html>
