<?php

//verifica si se ha hecho clic en el boton guardar
if(filter_input(INPUT_POST, 'btnGuardar'))
{
    
    /*propiedades del archivo*/
    $archivo_nombre=$_FILES['archivo']['name'];
    $archivo_tipo = $_FILES['archivo']['type'];
    $archivo_temp = $_FILES['archivo']['tmp_name'];
    
    //conexion con mysql
    $conn = mysqli_connect('localhost', 'root', '', 'jornadaUTVM') or die("Error al conectar al servidor");	
    
    //verificamos si no hay error en la conexion
    if(!$conn){
        $error= mysqli_error($conn);
        die("ERROR: ".$error["message"]);
    }
    
    //convertir la imagen en código binario
    $archivo_binario = (file_get_contents($archivo_temp));
    
    /* preparamos la sentencia sql
		* declarado unos paramentros en la sentencia sql (?)
		* recibiran valores desde el bind_param.
  */

$sql = "INSERT INTO ARCHIVOS (NOMBRE, TIPO, ARCHIVO) VALUES (?, ?, ?)";	
$stmt = mysqli_prepare($conn, $sql);
$stmt->bind_param('sss', $archivo_nombre, $archivo_tipo, $archivo_binario);

//ejecutamos la sentencia
if(mysqli_stmt_execute($stmt))
{
    echo "Se ha guardado el archivo en la base de Datos con exito<br/>
    &Uacute;ltimo id insertado: <a href='ver.php?id=". mysqli_stmt_insert_id($stmt)."'>". mysqli_stmt_insert_id($stmt)."</a>";
} else
{
    echo "Ocurrio un problema al guarda su archivo. ". mysqli_stmt_error($stmt)."<br/>";
}
mysqli_stmt_close($stmt);
mysqli_close($conn);
}
?>

<!--FORMULARIO-->
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
                <h3>Guardar un archivo en MySQL</h3>
                <form method="post" action="" enctype="multipart/form-data">
                    <input type="file" name="archivo" /><br/><br/>
                    <input type="submit" name="btnGuardar" value="Guardar" />
                </form>
            </section>
        </main>
        <footer>
            <p>Administrador Jornada Academica © UTVM</p>
        </footer>
    </body>
</html>

