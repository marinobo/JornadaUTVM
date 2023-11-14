<?php

//verifica si se ha hecho clic en el boton guardar
if(filter_input(INPUT_POST, 'btnGuardar'))
{
    /*propiedades del archivo*/
    $archivo_nombre=$_FILES['archivo']['name'];
    $archivo_tipo = $_FILES['archivo']['type'];
    $archivo_temp = $_FILES['archivo']['tmp_name'];
    
    //conexion con mysql
    $conn = mysqli_connect('localhost', 'root', '', 'jornadautvm') or die("Error al conectar al servidor");	
    
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
    if (mysqli_stmt_execute($stmt))
    {
        $ultimoId = mysqli_stmt_insert_id($stmt);
        echo "<script>
        alert('Se ha guardado el archivo en la base de datos con éxito. Último id insertado: $ultimoId');
        window.location.href='guardar.php?';
        </script>";
    } else
    {
        echo "<script>
        alert('Ocurrió un problema al guardar su archivo. " . mysqli_stmt_error($stmt) . "');
        </script>";
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

session_start();
// Verifica si la variable de sesión está configurada
if (!isset($_SESSION['usuario']))
{
    // Si no está configurada, redirige a la página de inicio de sesión
    header("Location: index.php");
    exit();
}

//forms
include 'forms.php';
include 'forms_ponentes.php';
include 'forms_convocatoria.php';

?>


<!--FORMULARIO-->
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style_forms.css">
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/bootstrap.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <!-- Agrega esto en el head de tu documento -->
        <title>Administrador</title>
    </head>
    <body>
        <header>
            <h1>Panel de Administrador</h1>
            <nav>
                <ul>
                    <button id="btnCerrarSesion" class="btn btn-primary">Cerrar Sesión</button>
                </ul>
            </nav>
        </header>
        <main>

        <!-- Contenido del panel de administrador -->
        <section class="content">
            <h3>Guardar un archivo en MySQL</h3>
            <form method="post" action="" enctype="multipart/form-data">
                <input type="file" name="archivo" /><br/><br/>
                <input type="submit" name="btnGuardar" value="Guardar" />
            </form>
        </section>
        
        <!-- Contenido del panel de actividades -->
        <section class="content">
            <div class="form-container">
                <form method="post" action="" class="activity-form">
                    <h1>Actividades</h1>
                    <select class="form-act" name="dia" id="dia-act">
                        <option value="" selected disabled>Elige un día</option>
                        <option value="diauno">Día 1</option>
                        <option value="diados">Día 2</option>
                        <option value="diatres">Día 3</option>
                    </select>
                    <input type="text" name="nameAct" id="nameAct" placeholder="Nombre de la actividad">
                    <input type="text" name="asist" id="asist" placeholder="Asistentes, ej: 1º y 4º">
                    <input type="date" name="fecha" id="fecha">
                    <input type="text" name="horaAct" id="horaAct" placeholder="Hora de la actividad, ej: 9:00 hrs.">
                    <input type="text" name="lugarAct" id="lugarAct" placeholder="Lugar de la actividad">
                    <input type="text" name="PonCord" id="PonCord" placeholder="Nombre del ponente o coordinador de la actividad">
                    <input type="text" name="ResAct" id="ResAct" placeholder="Responsables de la actividad">
                    <input type="submit" name="btnGuardarAct" value="Guardar">
                </form>
            </div>
        </section>
        
        <!-- Contenido del panel de ponentes -->
        <section class="content">
            <div class="form-container">
                <form method="post" action="" class="activity-form" enctype="multipart/form-data">
                    <h1>Ponentes</h1>
                    <input type="text" name="namePon" placeholder="Nombre del ponente">
                    <input type="text" name="ocupPon" placeholder="Ocupación del ponente">
                    <textarea name="desPon" placeholder="Descripción del ponente"></textarea>                        
                    <input type="file" name="fotoPon">
                    <input type="submit" name="btnGuardarPon" value="Guardar">
                </form>
            </div>
        </section>
        
        <!-- Contenido del panel de convocatorias -->
        <section class="content">
            <div class="form-container">
                <form method="post" action="" class="activity-form" enctype="multipart/form-data">
                    <h1>Convocarorias</h1>
                    <select class="form-con" name="tipo">
                        <option value="">Elige el tipo de convocatoria</option>
                        <option value="deportiva">Deportiva</option>
                        <option value="cultural">Cultural</option>
                        <option value="talleres">Taller</option>
                    </select>
                    <input type="text" name="nameCon" placeholder="Nombre de la convocatoria">
                    <input type="file" name="archivoCon" /><br/><br/>
                    <input type="submit" name="btnGuardarCon" value="Guardar">
                </form>
            </div>
        </section>
    
    </main>
    <footer>
        <p>Administrador Jornada Academica © UTVM</p>
    </footer>
</body>

<script>
//serrar sesion
document.getElementById("btnCerrarSesion").addEventListener("click", function() {
    // Redirige al archivo PHP que cierra la sesión 
    window.location.href = "cerrar_sesion.php";
    });
</script>
</html>

