<?php
if (isset($_POST['btnGuardarPon']))
{
    $nombrePon = $_POST['namePon'];
    $ocupacionPon = $_POST['ocupPon'];
    $descripcionPon = $_POST['desPon'];
    
    // Verificar si se ha cargado un archivo
    if (isset($_FILES['fotoPon']) && $_FILES['fotoPon']['error'] == 0)
    {
        // Propiedades del archivo
        $foto_nombre = $_FILES['fotoPon']['name'];
        $foto_tipo = $_FILES['fotoPon']['type'];
        $foto_temp = $_FILES['fotoPon']['tmp_name'];
        
        // Convertir la imagen en código binario
        $foto_binario = (file_get_contents($foto_temp));
    } else
    {
        // Puedes manejar el caso en que no se cargue un archivo si es necesario
        $foto_nombre = null;
        $foto_tipo = null;
        $foto_binario = null;
    }
    
    // Conexión con MySQL
    $conn = mysqli_connect('localhost', 'root', '', 'jornadautvm') or die("Error al conectar al servidor");
    
    // Preparamos la sentencia SQL
    $sql = "INSERT INTO PONENTES (nombre_ponente, ocupacion_ponente, descripcion_ponente, foto_ponente_nombre, foto_ponente_tipo, foto_ponente) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    $stmt->bind_param('ssssss', $nombrePon, $ocupacionPon, $descripcionPon, $foto_nombre, $foto_tipo, $foto_binario);
    
    // Ejecutamos la sentencia
    if (mysqli_stmt_execute($stmt))
    {
        $ultimoId = mysqli_stmt_insert_id($stmt);
        echo "<script>
        alert('Se ha guardado el ponente en la base de datos con éxito.');
        window.location.href='guardar.php?';
        </script>";
    } else
    {
        echo "<script>
        alert('Ocurrió un problema al guardar el ponente. " . mysqli_stmt_error($stmt) . "');
        </script>";
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
