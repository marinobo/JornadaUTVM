<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_home.css">
    <title>Administrador</title>
</head>
<body>
    <header>
        <h1>Panel de Administrador</h1>
        <nav>
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Usuarios</a></li>
                <li><a href="#">Configuración</a></li>
                <li><a href="#">Salir</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="content">
            <!-- Contenido del panel de administrador -->
            <h1>Subir Documentos</h1>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <label for="file">Seleccionar Archivo:</label>
                <input type="file" name="file" id="file" required>
                <br>
                <input type="submit" value="Subir Archivo">
            </form>
        </section>
    </main>
    <footer>
        <p>Administrador Jornada Academica © UTVM</p>
    </footer>
</body>
</html>