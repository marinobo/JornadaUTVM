<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Jornada Académica|Inicio</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Numans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="stylesJor.css">
        <script src="js/bootstrap.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="index.js"></script>
        <script src="modal.js"></script>
    </head>
    <body>
        <header>
            <img src="img/b.jpg" id="logo" alt="header" width="100%">
        </header>
        
        <nav>
            <ul>
                <li><a href="#talleres">Convocatorias</a></li>
                <li><a href="#ponentes">Ponentes</a></li>
                <li><a href="#actividades">Actividades</a></li>
                <li><a href="#galeria">Galería</a></li>
            </ul>
        </nav>
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <div class="top-container">
                    <div class="titulo">
                        <h1 class="display-6">Jornada Académica</h1>
                        <h1>Tecnologías de la Información</h1>
                    </div>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                </div>
            </div>
            
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/universidad-del-valle-del-mezuital.jpg">
                    <div class="container">
                        <div class="carousel-caption text-start"></div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="img/03.jpg">
                    <div class="container">
                        <div class="carousel-caption"></div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        
        <section id="actividades">
            <div class="baner">
                <h1 class="display-6">Actividades</h1>
            </div>
            <div class="seccion1">
                <div class="link-row">
                    <a  onclick="openContent(event, '1');">
                        <div class="tablink">10 de noviembre</div>
                    </a>
                    <a onclick="openContent(event, '2');">
                        <div class="tablink">11 de noviembre</div>
                    </a>
                    <a  onclick="openContent(event, '3');">
                        <div class="tablink">12 de noviembre</div>
                    </a>
                </div>
                <div class="confes">
                    <div id="1" class="content">
                        <a href="#actividades" class="openModalBtnPro btn btn-success">Descargar programa</a>
                        
                        <?php
                        include 'admin/db.php';
                        // Verificar la conexión
                        if ($conexion->connect_error)
                        {
                            die("Conexión fallida: " . $conexion->connect_error);
                        }
                        // Realizar la consulta SQL con filtro para el campo "dia"
                        $sql = "SELECT id_actividad, nombre_actividad, asistentes,fecha, hora_actividad,lugar, ponente_coordinador, responsables FROM actividades WHERE dia = 'diauno'";
                        $result = $conexion->query($sql);
                        // Mostrar los resultados en la tabla
                        if ($result->num_rows > 0)
                        {
                            echo "<table class='table table-striped table-bordered'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th scope='col'>Actividad</th>";
                            echo "<th scope='col'>Asisten</th>";
                            echo "<th scope='col'>Horario</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody class='table-group-divider'>";
                            while ($row = $result->fetch_assoc())
                            {
                                echo "<tr>";
                                echo "<td><a href='#actividades' class='openModalBtnCont' onclick='openModal(\"myModalCont{$row['id_actividad']}\")'>" . $row["nombre_actividad"] . "</a></td>";
                                echo "<td>" . $row["asistentes"] . "</td>";
                                echo "<td>" . $row["hora_actividad"] . "</td>";
                                echo "</tr>";
                                // Crear modal para cada actividad
                                echo "<div id='myModalCont{$row['id_actividad']}' class='modal'>";
                                echo "<div class='modal-content'>";
                                echo " <div class='title-modal'><h1>{$row['nombre_actividad']}</h1></div>";
                                echo "<hr>";
                                echo "<h2>Imparte:</h2>";
                                echo "<h3>{$row['ponente_coordinador']}</h3>";
                                echo "<h2>Fecha y hora:</h2>";
                                echo "<h3>{$row['fecha']}</h3>";
                                echo "<h3>{$row['hora_actividad']}</h3>";
                                echo "<h2>Lugar:</h2>";
                                echo "<h3>{$row['lugar']}</h3>";
                                echo "<h4>Responsables:</h4>";
                                echo "<h5> {$row['responsables']}</h5>";
                                echo "<button class='modal-close btn btn-danger' onclick='closeModal(\"myModalCont{$row['id_actividad']}\")'>Cerrar</button>";
                                echo "</div>";
                                echo "</div>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                        } else
                        {
                            echo "<p>No hay resultados para 'diauno'</p>";
                        }
                        // Cerrar la conexión
                        $conexion->close();
                        ?>
                    </div>
                    
                    <div id="2" class="content">
                        <a href="#actividades" class="openModalBtnPro btn btn-success">Descargar programa</a>
                        
                        <?php
                        include 'admin/db.php';
                        // Verificar la conexión
                        if ($conexion->connect_error)
                        {
                            die("Conexión fallida: " . $conexion->connect_error);
                        }
                        // Realizar la consulta SQL con filtro para el campo "dia"
                        $sql = "SELECT id_actividad, nombre_actividad, asistentes,fecha, hora_actividad,lugar, ponente_coordinador, responsables FROM actividades WHERE dia = 'diados'";
                        $result = $conexion->query($sql);
                        // Mostrar los resultados en la tabla
                        if ($result->num_rows > 0)
                        {
                            echo "<table class='table table-striped table-bordered'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th scope='col'>Actividad</th>";
                            echo "<th scope='col'>Asisten</th>";
                            echo "<th scope='col'>Horario</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody class='table-group-divider'>";
                            while ($row = $result->fetch_assoc())
                            {
                                echo "<tr>";
                                echo "<td><a href='#actividades' class='openModalBtnCont' onclick='openModal(\"myModalCont{$row['id_actividad']}\")'>" . $row["nombre_actividad"] . "</a></td>";
                                echo "<td>" . $row["asistentes"] . "</td>";
                                echo "<td>" . $row["hora_actividad"] . "</td>";
                                echo "</tr>";
                                // Crear modal para cada actividad
                                echo "<div id='myModalCont{$row['id_actividad']}' class='modal'>";
                                echo "<div class='modal-content'>";
                                echo " <div class='title-modal'><h1>{$row['nombre_actividad']}</h1></div>";
                                echo "<hr>";
                                echo "<h2>Imparte:</h2>";
                                echo "<h3>{$row['ponente_coordinador']}</h3>";
                                echo "<h2>Fecha y hora:</h2>";
                                echo "<h3>{$row['fecha']}</h3>";
                                echo "<h3>{$row['hora_actividad']}</h3>";
                                echo "<h2>Lugar:</h2>";
                                echo "<h3>{$row['lugar']}</h3>";
                                echo "<h4>Responsables:</h4>";
                                echo "<h5> {$row['responsables']}</h5>";
                                echo "<button class='modal-close btn btn-danger' onclick='closeModal(\"myModalCont{$row['id_actividad']}\")'>Cerrar</button>";
                                echo "</div>";
                                echo "</div>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                        } else
                        {
                            echo "<p>No hay resultados para 'dia dos'</p>";
                        }
                        // Cerrar la conexión
                        $conexion->close();
                        ?>
                    </div>
                    
                    <div id="3" class="content">
                        <a href="#actividades" class="openModalBtnPro btn btn-success">Descargar programa</a>
                        
                        <?php
                        include 'admin/db.php';
                        // Verificar la conexión
                        if ($conexion->connect_error)
                        {
                            die("Conexión fallida: " . $conexion->connect_error);
                        }
                        // Realizar la consulta SQL con filtro para el campo "dia"
                        $sql = "SELECT id_actividad, nombre_actividad, asistentes,fecha, hora_actividad,lugar, ponente_coordinador, responsables FROM actividades WHERE dia = 'diatres'";
                        $result = $conexion->query($sql);
                        // Mostrar los resultados en la tabla
                        if ($result->num_rows > 0)
                        {
                            echo "<table class='table table-striped table-bordered'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th scope='col'>Actividad</th>";
                            echo "<th scope='col'>Asisten</th>";
                            echo "<th scope='col'>Horario</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody class='table-group-divider'>";
                            while ($row = $result->fetch_assoc())
                            {
                                echo "<tr>";
                                echo "<td><a href='#actividades' class='openModalBtnCont' onclick='openModal(\"myModalCont{$row['id_actividad']}\")'>" . $row["nombre_actividad"] . "</a></td>";
                                echo "<td>" . $row["asistentes"] . "</td>";
                                echo "<td>" . $row["hora_actividad"] . "</td>";
                                echo "</tr>";
                                // Crear modal para cada actividad
                                echo "<div id='myModalCont{$row['id_actividad']}' class='modal'>";
                                echo "<div class='modal-content'>";
                                echo " <div class='title-modal'><h1>{$row['nombre_actividad']}</h1></div>";
                                echo "<hr>";
                                echo "<h2>Imparte:</h2>";
                                echo "<h3>{$row['ponente_coordinador']}</h3>";
                                echo "<h2>Fecha y hora:</h2>";
                                echo "<h3>{$row['fecha']}</h3>";
                                echo "<h3>{$row['hora_actividad']}</h3>";
                                echo "<h2>Lugar:</h2>";
                                echo "<h3>{$row['lugar']}</h3>";
                                echo "<h4>Responsables:</h4>";
                                echo "<h5> {$row['responsables']}</h5>";
                                echo "<button class='modal-close btn btn-danger' onclick='closeModal(\"myModalCont{$row['id_actividad']}\")'>Cerrar</button>";
                                echo "</div>";
                                echo "</div>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                        } else
                        {
                            echo "<p>No hay resultados para 'dia tres'</p>";
                        }
                        // Cerrar la conexión
                        $conexion->close();
                        ?>
                    </div>
                </div>
                
                <div id="Modal-programa">
                    <div class="modal-content-pro">
                        <iframe id="pdfContainer" src="img/JornadaAcade_micaTI2021 (1) (1).pdf" frameborder="0"></iframe>
                        <a href="#actividades" class="btn btn-danger" id="close-pro">Cerrar</a>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="ponentes">
            <div class="baner">
                <h1 class="display-6">Ponentes</h1>
            </div>
            <div class="seccion">
                
                <?php
                include 'admin/db.php';
                // Verificar la conexión
                if ($conexion->connect_error)
                {
                    die("Conexión fallida: " . $conexion->connect_error);
                }
                // Realizar la consulta SQL con filtro para el campo "dia"
                $sql = "SELECT id_ponente, nombre_ponente, ocupacion_ponente, descripcion_ponente, foto_ponente_nombre, foto_ponente_tipo, foto_ponente FROM ponentes";
                $result = $conexion->query($sql);
                // Mostrar los resultados en la tabla
                if ($result->num_rows > 0)
                {
                    while ($row = $result->fetch_assoc())
                    {
                        $foto = $row ['foto_ponente'];
                        echo "<div class='card'>";
                        echo"<div class='image'>";
                        echo"<div class='image'>";
                        echo"<img src='data:image/png;base64," . base64_encode($foto) . "' alt='Imagen_ponente'>";
                        echo"</div>";
                        echo"</div>";
                        echo"<div class='name_p'>";
                        echo"<a href='#ponente' class='openModalBtnCont' onclick='openModal(\"myModalCont{$row['id_ponente']}\")'>" . $row["nombre_ponente"] . "</a>";
                        echo" </div>";
                        echo"<p>{$row['ocupacion_ponente']}</p>";
                        echo" </div> ";
                        // Crear modal para cada actividad
                        echo "<div id='myModalCont{$row['id_ponente']}' class='modal'>";
                        echo "<div class='modal-content'>";
                        echo " <div class='title-modal'><h1>{$row['nombre_ponente']}</h1></div>";
                        echo "<hr>";
                        echo "<h2>Imparte:</h2>";
                        echo "<h3>{$row['ocupacion_ponente']}</h3>";
                        echo "<h4>Responsables:</h4>";
                        echo "<h5> {$row['descripcion_ponente']}</h5>";
                        echo "<button class='modal-close btn btn-danger' onclick='closeModal(\"myModalCont{$row['id_ponente']}\")'>Cerrar</button>";
                        echo "</div>";
                        echo "</div>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                } else
                {
                    echo "<p>No hay resultados</p>";
                }
                // Cerrar la conexión
                $conexion->close();
                ?>
            </div>
        </section>
        
        <section id="talleres">
            <div class="baner">
                <h1 class="display-6">Convocatorias <span>/</span> <span>Talleres</span></h1>
            </div>
            <div class="seccion1">
                <div class="link-row">
                    <a  onclick="openContent(event, '4');">
                        <div class="tablink">Deportivas</div>
                    </a>
                    <a onclick="openContent(event, '5');">
                        <div class="tablink">Culturales</div>
                    </a>
                    <a  onclick="openContent(event, '6');">
                        <div class="tablink">Talleres</div>
                    </a>
                </div>
                <div class="confes">
                    <div id="4" class="content">
                        <div class="seccion">
                            
                            <?php
                            // Conexión a la base de datos
                            include 'admin/db.php';
                            // Verifica la conexión
                            if (!$conexion)
                            {
                                die("La conexión falló: " . mysqli_connect_error());
                            }
                            // consulta a la base de datos
                            $query = "SELECT * FROM convocatorias";
                            $resultado = mysqli_query($conexion, $query);
                            // verificar si hay resultados
                            if (mysqli_num_rows($resultado) > 0)
                            {
                                $deportivas = [];
                                while ($fila = mysqli_fetch_assoc($resultado))
                                {
                                    $id_convocatoria = $fila['id_convocatoria'];
                                    $tipo_convocatoria = $fila['tipo_convocatoria'];
                                    $nombre_convocatoria = $fila['nombre_convocatoria'];
                                    $descripcion_convocatoria = $fila['descripcion_convocatoria'];
                                    $archivo_convocatoria_binario = $fila['archivo_convocatoria_binario'];
                                    $foto_convocatoria_binario = $fila['foto_convocatoria_binario'];
                                    // genera cards dinámicamente solo para convocatorias deportivas
                                    if ($tipo_convocatoria == "deportiva")
                                    {
                                        $tarjeta = "
                                        <div class='card'>
                                            <div class='image'>
                                                <img src='data:image/png;base64," . base64_encode($foto_convocatoria_binario) . "' alt='Imagen 1'>
                                            </div>
                                            <div class='name_p'>
                                                <h2>$nombre_convocatoria</h2>
                                            </div>
                                            <p>$descripcion_convocatoria</p>
                                            <button type='button' class='btn btn-success open-pdf-modal' data-pdf-src='data:application/pdf;base64," . base64_encode($archivo_convocatoria_binario) . "'>Leer más</button>
                                            <div id='pdf-container-$id_convocatoria' class='pdf-container' style='display: none;'>
                                                <!-- Aquí puedes agregar un elemento adicional si es necesario -->
                                            </div>
                                        </div>";
                                        // Agregar la tarjeta al array correspondiente
                                        $deportivas[] = $tarjeta;
                                    }
                                }
                                // Imprimir cards deportivas
                                echo implode('', $deportivas);
                                // Modal para mostrar el contenido del PDF
                                echo "
                                <div id='Modal-programa' class='modal'>
                                    <div class='modal-content-pro'>
                                        <iframe id='pdfContainer' src='' frameborder='0'></iframe>
                                        <a href='#talleres' class='btn btn-danger' id='close-pro'>Cerrar</a>
                                    </div>
                                </div>";
                            } else
                            {
                                echo "No hay convocatorias disponibles.";
                            }
                            // se cierra conexión
                            mysqli_close($conexion);
                            ?>
                        </div>
                    </div>
                    
                    <div id="5" class="content">
                        <div class="seccion">
                            
                            <?php
                            // Conexión a la base de datos
                            include 'admin/db.php';
                            // Verifica la conexión
                            if (!$conexion)
                            {
                                die("La conexión falló: " . mysqli_connect_error());
                            }
                            // consulta a la base de datos
                            $query = "SELECT * FROM convocatorias";
                            $resultado = mysqli_query($conexion, $query);
                            // verificar si hay resultados
                            if (mysqli_num_rows($resultado) > 0)
                            {
                                $culturales = [];
                                while ($fila = mysqli_fetch_assoc($resultado))
                                {
                                    $id_convocatoria = $fila['id_convocatoria'];
                                    $tipo_convocatoria = $fila['tipo_convocatoria'];
                                    $nombre_convocatoria = $fila['nombre_convocatoria'];
                                    $descripcion_convocatoria = $fila['descripcion_convocatoria'];
                                    $archivo_convocatoria_binario = $fila['archivo_convocatoria_binario'];
                                    $foto_convocatoria_binario = $fila['foto_convocatoria_binario'];
                                    // genera cards dinámicamente solo para convocatorias culturales
                                    if ($tipo_convocatoria == "cultural")
                                    {
                                        $tarjeta = "
                                        <div class='card'>
                                            <div class='image'>
                                                <img src='data:image/png;base64," . base64_encode($foto_convocatoria_binario) . "' alt='Imagen 1'>
                                            </div>
                                            <div class='name_p'>
                                                <h2>$nombre_convocatoria</h2>
                                            </div>
                                            <p>$descripcion_convocatoria</p>
                                            <button type='button' class='btn btn-success open-pdf-modal' data-pdf-src='data:application/pdf;base64," . base64_encode($archivo_convocatoria_binario) . "'>Leer más</button>
                                            <div id='pdf-container-$id_convocatoria' class='pdf-container' style='display: none;'>
                                                <!-- Aquí puedes agregar un elemento adicional si es necesario -->
                                            </div>
                                        </div>";
                                        // Agregar la tarjeta al array correspondiente
                                        $culturales[] = $tarjeta;
                                    }
                                }
                                // Imprimir cards deportivas
                                echo implode('', $culturales);
                                // Modal para mostrar el contenido del PDF
                                echo "
                                <div id='Modal-programa' class='modal'>
                                    <div class='modal-content-pro'>
                                        <iframe id='pdfContainer' src='' frameborder='0'></iframe>
                                        <a href='#talleres' class='btn btn-danger' id='close-pro'>Cerrar</a>
                                    </div>
                                </div>";
                            } else
                            {
                                echo "No hay convocatorias disponibles.";
                            }
                            // se cierra conexión
                            mysqli_close($conexion);
                            ?>
                        </div>
                    </div>
                    
                    <div id="6" class="content">
                        <div class="seccion">
                            <?php
                            // Conexión a la base de datos
                            include 'admin/db.php';
                            // Verifica la conexión
                            if (!$conexion)
                            {
                                die("La conexión falló: " . mysqli_connect_error());
                            }
                            // consulta a la base de datos
                            $query = "SELECT * FROM convocatorias";
                            $resultado = mysqli_query($conexion, $query);
                            // verificar si hay resultados
                            if (mysqli_num_rows($resultado) > 0)
                            {
                                $tallers = [];
                                while ($fila = mysqli_fetch_assoc($resultado))
                                {
                                    $id_convocatoria = $fila['id_convocatoria'];
                                    $tipo_convocatoria = $fila['tipo_convocatoria'];
                                    $nombre_convocatoria = $fila['nombre_convocatoria'];
                                    $descripcion_convocatoria = $fila['descripcion_convocatoria'];
                                    $archivo_convocatoria_binario = $fila['archivo_convocatoria_binario'];
                                    $foto_convocatoria_binario = $fila['foto_convocatoria_binario'];
                                    // genera cards dinámicamente solo para convocatorias talleres
                                    if ($tipo_convocatoria == "talleres")
                                    {
                                        $tarjeta = "
                                        <div class='card'>
                                            <div class='image'>
                                                <img src='data:image/png;base64," . base64_encode($foto_convocatoria_binario) . "' alt='Imagen 1'>
                                            </div>                     
                                            <div class='name_p'>
                                                <h2>$nombre_convocatoria</h2>
                                            </div>
                                            <p>$descripcion_convocatoria</p>
                                            <button type='button' class='btn btn-success open-pdf-modal' data-pdf-src='data:application/pdf;base64," . base64_encode($archivo_convocatoria_binario) . "'>Leer más</button>
                                            <div id='pdf-container-$id_convocatoria' class='pdf-container' style='display: none;'>
                                                <!-- Aquí puedes agregar un elemento adicional si es necesario -->
                                            </div>
                                        </div>";
                                        // Agregar la tarjeta al array correspondiente
                                        $tallers[] = $tarjeta;
                                    }
                                }
                                // Imprimir cards deportivas
                                echo implode('', $tallers);
                                // Modal para mostrar el contenido del PDF
                                echo "
                                <div id='Modal-programa' class='modal'>
                                    <div class='modal-content-pro'>
                                        <iframe id='pdfContainer' src='' frameborder='0'></iframe>
                                        <a href='#talleres' class='btn btn-danger' id='close-pro'>Cerrar</a>
                                    </div>
                                </div>";
                            } else
                            {
                                echo "No hay convocatorias disponibles.";
                            }
                            // se cierra conexión
                            mysqli_close($conexion);
                            ?>
                        </div>
                    </div>
                </div>  
            </div>
        </section>
        
        <section id="galeria">
            <div class="baner">
                <h1 class="display-6">Galería</h1>
            </div>
            <br>
            <div class="content-galery">
                <h1 class="t-jor display-6"> 2017</h1>
                <section class="gallery-container">
                    <img src="img/1.jpeg" alt="Imagen 1">
                    <img src="img/2.jpeg" alt="Imagen 2">
                    <img src="img/3.jpeg" alt="Imagen 3">
                    <img src="img/4.jpeg" alt="Imagen 1">
                    <img src="img/5.jpeg" alt="Imagen 2">
                    <img src="img/6.jpeg" alt="Imagen 3">
                </section>
            </div>
            <div class="lightbox">
                <span class="close">&times;</span>
                <img class="lightbox-content" id="lightbox-img">
            </div>
        </section>
        
        <footer>
            <div class="footer-content">
                <p>&copy; 2022 Universidad Tecnológica del Valle del Mezquital</p>
                <br>
                <p>Contacto</p>
                <address>
                    Carretera Ixmiquilpan-Capula Km. 4<br>
                    El Nith, C.P. 42300,<br>
                    Ixmiquilpan, Hidalgo, México
                </address>
            </div>
        </footer>
        
        <script>
        
        function openModal(modalId)
        {
            document.getElementById(modalId).style.display = "flex";
        }
        function closeModal(modalId)
        {
            document.getElementById(modalId).style.display = "none";
        }
        // Cerrar el modal haciendo clic fuera de él
        window.onclick = function (event)
        {
            if (event.target.className === 'modal')
            {
                event.target.style.display = "none";
            }
        }
        </script>
    </body>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    //pdf-conv
    $(document).ready(function ()
    {
        $('.open-pdf-modal').click(function ()
        {
            var pdfSrc = $(this).data('pdf-src');
            $('#pdfContainer').attr('src', pdfSrc);
            $('#Modal-programa').show();
        });
        $('#close-pro').click(function ()
        {
            $('#Modal-programa').hide();
        });
    });
    //galeria
    const gallery = document.querySelector('.gallery-container');
    const lightbox = document.querySelector('.lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const closeBtn = document.querySelector('.close');
    
    gallery.addEventListener('click', (e) =>
    {
        if (e.target.tagName === 'IMG')
        {
            lightboxImg.src = e.target.src;
            lightbox.style.display = 'block';
        }
    });
    
    closeBtn.addEventListener('click', () =>
    {
        lightbox.style.display = 'none';
    });
    
    lightbox.addEventListener('click', (e) =>
    {
        if (e.target === lightbox)
        {
            lightbox.style.display = 'none';
        }
    });
    //galeria
    
    //modal convocatoria 
    var openModalBtns = document.getElementsByClassName('openModalBtnPro');
    var closeModalBtn = document.getElementById('close-pro');
    var modal = document.getElementById('Modal-programa');
    
    for (var i = 0; i < openModalBtns.length; i++)
    {
        openModalBtns[i].onclick = function()
        {
            modal.style.display = 'block';
        };
    }
    
    closeModalBtn.onclick = function()
    {
        modal.style.display = 'none';
    };
    
    window.onclick = function(event)
    {
        if (event.target === modal)
        {
            modal.style.display = 'none';
        }
    };
    // Obtén elementos del DOM pdf-C
    const openPdfButtonC = document.getElementById('open-pdf-c');
    const pdfModalC = document.getElementById('pdf-modal-c');
    const pdfIframeC = document.getElementById('pdf-iframe-c');
    
    // Agrega un evento click al enlace para abrir el modal
    openPdfButtonC.addEventListener('click', () =>
    {
        pdfModalC.style.display = 'block';
    });
    
    // Agrega un evento click para cerrar el modal al hacer clic fuera del contenido
    pdfModalC.addEventListener('click', (event) =>
    {
        if (event.target === pdfModalC)
        {
            pdfModalC.style.display = 'none';
        }
    })
    
    // Obtén elementos del DOM pdf-C
    const openButton = document.getElementById('open-modal');
    const ModalAct = document.getElementById('act-modal');
    
    // Agrega un evento click al enlace para abrir el modal
    openPButton.addEventListener('click', () =>{});
    
    // Agrega un evento click para cerrar el modal al hacer clic fuera del contenido
    pdfModalC.addEventListener('click', (event) =>
    {
        if (event.target === pdfModalC)
        {
            pdfModalC.style.display = 'none';
        }
    })
    //modal-ac
    </script>
</html>
