<?php
if (isset($_POST['btnGuardarCon'])) {
    $tipo = $_POST['tipo'];
    $nombreConvocatoria = $_POST['nameCon'];

    // Verificar si se ha cargado un archivo
    if (isset($_FILES['archivoCon']) && $_FILES['archivoCon']['error'] == 0) {
        // Propiedades del archivo
        $convocatoria_nombre = $_FILES['archivoCon']['name'];
        $convocatoria_tipo = $_FILES['archivoCon']['type'];
        $convocatoria_temp = $_FILES['archivoCon']['tmp_name'];

        // Convertir la imagen en código binario
        $foto_binario = (file_get_contents($convocatoria_temp));
    } else {
        // Puedes manejar el caso en que no se cargue un archivo si es necesario
        $convocatoria_nombre = null;
        $convocatoria_tipo = null;
        $foto_binario = null;
    }

    // Conexión con MySQL
    $conn = mysqli_connect('localhost', 'root', '', 'jornadautvm') or die("Error al conectar al servidor");

    // Preparamos la sentencia SQL
    $sql = "INSERT INTO convocatorias (tipo_convocatoria, nombre_convocatoria, archivo_convocatoria_nombre, archivo_convocatoria_tipo, archivo_convocatoria_binario) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    $stmt->bind_param('sssss', $tipo, $nombreConvocatoria, $convocatoria_nombre, $convocatoria_tipo, $foto_binario);

    // Ejecutamos la sentencia
    if (mysqli_stmt_execute($stmt)) {
        $ultimoId = mysqli_stmt_insert_id($stmt);
        echo "<script>
                alert('Se ha guardado la convocatoria en la base de datos con éxito.');
                window.location.href='guardar.php?';
              </script>";
    } else {
        echo "<script>
                alert('Ocurrió un problema al guardar la convocatiria. " . mysqli_stmt_error($stmt) . "');
              </script>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>