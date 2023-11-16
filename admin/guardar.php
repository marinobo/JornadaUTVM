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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="style_forms.css">
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/bootstrap.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="validar_archivos.js"></script>

        <!-- Agrega esto en el head de tu documento -->
        <title>Administrador</title>
    </head>
    <body>
        
        <header>
        <img src="../img/b.jpg" id="logo" alt="header" width="100%">

            <h1>Panel de Administrador</h1>
            
        </header>
        <nav class="nav">
                <ul>
                    <button id="btnCerrarSesion" class="btn btn-success">Cerrar Sesión</button>
                </ul>
            </nav>
            
        <main>
        <div class="seccion1">
                <div class="link-row">
                    <a  onclick="openContent(event, '7');">
                        <div class="tablink">Programa</div>
                    </a>
                    <a onclick="openContent(event, '8');">
                        <div class="tablink">Actividades</div>
                    </a>
                    <a  onclick="openContent(event, '9');">
                        <div class="tablink">Ponentes</div>
                    </a>
                    <a  onclick="openContent(event, '10');">
                        <div class="tablink">Convocatorias</div>
                    </a>
                </div>
            
        <!-- Contenido del panel de administrador -->
        <section id="7" class="content">
            <div class="form-container">
                <form method="post" action="" class="activity-form" enctype="multipart/form-data">
                    <h1>Guardar programa</h1>
                    <label for="archivoCon">Seleccione un archivo PDF no mayor a 3 MB</label>
                    <input type="file" name="archivo" requiredaccept=".pdf" onchange="validateFile(this)"/><br/><br/>
                    <input type="submit" name="btnGuardar" value="Guardar" />
                </form>
            </div>
        </section>
        
        <!-- Contenido del panel de actividades -->
        <section id="8" class="content">
            <div class="form-container">
                <form method="post" action="" class="activity-form">
                    <h1>Actividades</h1>
                    <select class="form-act" name="dia" id="dia-act" required>
                        <option value="" selected disabled>Elige un día</option>
                        <option value="diauno">Día 1</option>
                        <option value="diados">Día 2</option>
                        <option value="diatres">Día 3</option>
                    </select>
                    <input type="text" name="nameAct" id="nameAct" placeholder="Nombre de la actividad" required>
                    <input type="text" name="asist" id="asist" placeholder="Asistentes, ej: 1º y 4º" required>
                    <input type="date" name="fecha" id="fecha" required>
                    <input type="text" name="horaAct" id="horaAct" placeholder="Hora de la actividad, ej: 9:00 hrs." required>
                    <input type="text" name="lugarAct" id="lugarAct" placeholder="Lugar de la actividad" required>
                    <input type="text" name="PonCord" id="PonCord" placeholder="Nombre del ponente o coordinador de la actividad" required>
                    <input type="text" name="ResAct" id="ResAct" placeholder="Responsables de la actividad" required>
                    <input type="submit" name="btnGuardarAct" value="Guardar">
                </form>
            </div>
        </section>
        
        <!-- Contenido del panel de ponentes -->
        <section id="9" class="content">
            <div class="form-container">
                <form method="post" action="" class="activity-form" enctype="multipart/form-data">
                    <h1>Ponentes</h1>
                    <input type="text" name="namePon" placeholder="Nombre del ponente" required>
                    <input type="text" name="ocupPon" placeholder="Ocupación del ponente" required>
                    <textarea name="desPon" placeholder="Descripción del ponente" required></textarea>
                    <label for="fotoCon">Seleccione una imagen (jpg, jpeg, png) no mayor a 3 MB</label>                        
                    <input type="file" name="fotoPon" required required accept=".jpg, .jpeg, .png" onchange="validateFile(this)">
                    <input type="submit" name="btnGuardarPon" value="Guardar">
                </form>
            </div>
        </section>
    
        <!-- Contenido del panel de convocatorias -->
        <section id="10" class="content">
            <div class="form-container">
                <form method="post" action="" class="activity-form" enctype="multipart/form-data">
                    <h1>Convocarorias</h1>
                    <select class="form-con" name="tipo" required>
                        <option value="">Elige el tipo de convocatoria</option>
                        <option value="deportiva">Deportiva</option>
                        <option value="cultural">Cultural</option>
                        <option value="talleres">Taller</option>
                    </select>
                    <input type="text" name="nameCon" placeholder="Nombre de la convocatoria" required>
                    <textarea name="desCon" placeholder="Breve descripción de la convocatoria" required></textarea>   
                    <label for="fotoCon">Seleccione una imagen (jpg, jpeg, png) no mayor a 3 MB</label>
                    <input type="file" name="fotoCon" id="fotoCon" required accept=".jpg, .jpeg, .png" onchange="validateFile(this)">
                    <label for="archivoCon">Seleccione un archivo PDF no mayor a 3 MB</label>
                    <input type="file" name="archivoCon" id="archivoCon" required accept=".pdf" onchange="validateFile(this)"><br/><br/>
                    <input type="submit" name="btnGuardarCon" value="Guardar">
                </form>
            </div>
        </section>
    </main>
</div> 
<footer>
    <p>Administrador Jornada Academica © UTVM</p>
</footer>
</body>

<script>
//serrar sesion
document.getElementById("btnCerrarSesion").addEventListener("click", function()
{
    // Redirige al archivo PHP que cierra la sesión 
    window.location.href = "cerrar_sesion.php";
});

///tab
function openContent(evt, contentName)
{
    var i, x, tablinks;
    x = document.getElementsByClassName("content");
    for (i = 0; i < x.length; i++)
    {
        x[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < x.length; i++)
    {
        tablinks[i].classList.remove("tablink-active"); // Elimina la clase de la pestaña activa actual
    }
    document.getElementById(contentName).style.display = "block";
    evt.currentTarget.firstElementChild.classList.add("tablink-active"); // Agrega la clase a la pestaña activa
}
</script>
</html>

