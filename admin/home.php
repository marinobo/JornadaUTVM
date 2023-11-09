<!DOCTYPE html>
<html lang="es">
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
            <div class="container">
                <div class="position-absolute top-50 start-25 traslate-middle">
                    <h1 class="text-center mb-4">Subir documentos</h1>
                    <hr>
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="file" name="documento" id="">
                        <input type="submit">
                    </form>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        </section>
    </main>
    <footer>
        <p>Administrador Jornada Academica © UTVM</p>
    </footer>
</body>
</html>

<?php

$tamanio = 4000;

if(isset($_FILES['documento']) && $_FILES['documento']['type'] == 'application/pdf')
{
    if( $_FILES['documento']['size'] < ($tamanio * 1024) )
    {
        move_uploaded_file( $_FILES['documento']['tmp_name'], 'documentos/' . $_FILES['documento']['name']);
        echo
        '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        El documento se ha guardado correctamente.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    } else
    {
        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Error al subir el documento peso superior al permitido !.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    }
} else if(isset($_FILES['documento']) && $_FILES['documento']['type'] != 'application/pdf')
{
    echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    Solo se admiten documentos PDF
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
}
?>
