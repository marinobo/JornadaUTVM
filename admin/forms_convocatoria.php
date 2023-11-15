<?php
if (isset($_POST['btnGuardarCon']))
{
    $tipo = $_POST['tipo'];
    $nombreConvocatoria = $_POST['nameCon'];
    $descripcionConvocatoria = $_POST['desCon'];
    
    // Verificar si se ha cargado una imagen
    if (isset($_FILES['fotoCon']) && $_FILES['fotoCon']['error'] == 0)
    {
        $foto_nombre = $_FILES['fotoCon']['name'];
        $foto_tipo = $_FILES['fotoCon']['type'];
        $foto_temp = $_FILES['fotoCon']['tmp_name'];
        $foto_binario = file_get_contents($foto_temp);
    } else
    {
        $foto_nombre = null;
        $foto_tipo = null;
        $foto_binario = null;
    }

    // Verificar si se ha cargado un archivo PDF
    if (isset($_FILES['archivoCon']) && $_FILES['archivoCon']['error'] == 0)
    {
        $archivo_nombre = $_FILES['archivoCon']['name'];
        $archivo_tipo = $_FILES['archivoCon']['type'];
        $archivo_temp = $_FILES['archivoCon']['tmp_name'];
        $archivo_binario = file_get_contents($archivo_temp);
    } else
    {
        $archivo_nombre = null;
        $archivo_tipo = null;
        $archivo_binario = null;
    }
    
    // Conexión con MySQL
    $conn = mysqli_connect('localhost', 'root', '', 'jornadautvm') or die("Error al conectar al servidor");
    
    // Preparamos la sentencia SQL
    $sql = "INSERT INTO convocatorias 
            (tipo_convocatoria, nombre_convocatoria, descripcion_convocatoria, 
            foto_convocatoria_nombre, foto_convocatoria_tipo, foto_convocatoria_binario, 
            archivo_convocatoria_nombre, archivo_convocatoria_tipo, archivo_convocatoria_binario) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    $stmt->bind_param('sssssssss', $tipo, $nombreConvocatoria, $descripcionConvocatoria,
                      $foto_nombre, $foto_tipo, $foto_binario,
                      $archivo_nombre, $archivo_tipo, $archivo_binario);
    
    // Ejecutamos la sentencia
    if (mysqli_stmt_execute($stmt))
    {
        $ultimoId = mysqli_stmt_insert_id($stmt);
        echo "<script>
        alert('Se ha guardado la convocatoria en la base de datos con éxito.');
        window.location.href='guardar.php?';
        </script>";
    } else
    {
        echo "<script>
        alert('Ocurrió un problema al guardar la convocatoria. " . mysqli_stmt_error($stmt) . "');
        </script>";
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
