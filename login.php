<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
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
        <h1>Iniciar Sesión</h1>
    </header>
    
    <main>
        <section id="login" class="section">
            <h2>Iniciar Sesión</h2>
            <form action="procesar_login.php" method="POST">
                <label for="login-username">Nombre de Usuario:</label>
                <input type="text" id="login-username" name="login-username" required>
                
                <label for="login-password">Contraseña:</label>
                <input type="password" id="login-password" name="login-password" required>
                
                <button type="submit">Iniciar Sesión</button>
            </form>
        </section>
    </main>
</body>
</html>
