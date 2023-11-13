<?php

// Actividades
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnGuardarAct'])) {
    // Recupera los datos del formulario
    $dia = $_POST['dia'];
    $nameAct = $_POST['nameAct'];
    $asist = $_POST['asist'];
    $horaAct = $_POST['horaAct'];
    $PonCord = $_POST['PonCord'];
    $ResAct = $_POST['ResAct'];

    // Aquí deberías realizar validaciones adicionales según tus necesidades

    // Luego, puedes guardar los datos en la base de datos
    include('db.php'); // Asegúrate de tener un archivo db.php con la conexión a la base de datos

    $sql = "INSERT INTO actividades (dia, nombre_actividad, asistentes, hora_actividad, ponente_coordinador, responsables) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);

    // Verifica si la preparación de la sentencia fue exitosa
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssssss', $dia, $nameAct, $asist, $horaAct, $PonCord, $ResAct);
        mysqli_stmt_execute($stmt);

        // Verifica si la ejecución de la sentencia fue exitosa
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<script>alert('Se ha guardado la actividad con éxito');</script>";
        } else {
            echo "<script>alert('Ocurrió un problema al guardar la actividad');</script>";
        }

        // Cierra la sentencia preparada
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Ocurrió un problema al preparar la sentencia');</script>";
    }
   
    // Cierra la conexión a la base de datos
    mysqli_close($conexion);
    
}

// Ponentes
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnGuardarPon'])) {
    // Recupera los datos del formulario
    $namePon = $_POST['namePon'];
    $ocupPon = $_POST['ocupPon'];
    $desPon = $_POST['desPon'];

    // Manejo del archivo
    $fotoPon_nombre = $_FILES['fotoPon']['name'];
    $fotoPon_tipo = $_FILES['fotoPon']['type'];
    $fotoPon_temp = $_FILES['fotoPon']['tmp_name'];

    // Verifica si se subió un archivo
    if (!empty($fotoPon_nombre)) {
        // Convierte la imagen en código binario
        $fotoPon_binario = file_get_contents($fotoPon_temp);
    } else {
        $fotoPon_binario = null;
    }

    // Aquí deberías realizar validaciones adicionales según tus necesidades

    // Luego, puedes guardar los datos en la base de datos
    include('db.php'); // Asegúrate de tener un archivo db.php con la conexión a la base de datos

    $sql = "INSERT INTO ponentes (nombre_ponente, ocupacion_ponente, descripcion_ponente, foto_ponente) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);

    // Verifica si la preparación de la sentencia fue exitosa
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'sssb', $namePon, $ocupPon, $desPon, $fotoPon_binario);
        mysqli_stmt_execute($stmt);

        // Verifica si la ejecución de la sentencia fue exitosa
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<script>alert('Se ha guardado el ponente con éxito');</script>";
        } else {
            echo "<script>alert('Ocurrió un problema al guardar el ponente');</script>";
        }

        // Cierra la sentencia preparada
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Ocurrió un problema al preparar la sentencia');</script>";
    }
   
    // Cierra la conexión a la base de datos
    mysqli_close($conexion);
}
// Convocatorias
if (filter_input(INPUT_POST, 'btnGuardarCon')) {
    // Recupera los datos del formulario
    $tipo = $_POST['tipo'];
    $nameCon = $_POST['name-con'];

    // Manejo del archivo
    if (isset($_FILES['archivoCon']) && $_FILES['archivoCon']['error'] == UPLOAD_ERR_OK) {
        $archivoCon_nombre = $_FILES['archivoCon']['name'];
        $archivoCon_tipo = $_FILES['archivoCon']['type'];
        $archivoCon_temp = $_FILES['archivoCon']['tmp_name'];
        
        // Verificar si el archivo es válido
        if (is_uploaded_file($archivoCon_temp)) {
            $archivoCon_binario = file_get_contents($archivoCon_temp);
        } else {
            echo "<script>alert('Error: El archivo no se subió correctamente.');</script>";
            exit;
        }
    } else {
        // En este caso, no se ha subido ningún archivo
        $archivoCon_nombre = null;
        $archivoCon_tipo = null;
        $archivoCon_binario = null;
    }

    // Aquí deberías realizar validaciones adicionales según tus necesidades

    // Luego, puedes guardar los datos en la base de datos
    include('db.php'); // Asegúrate de tener un archivo db.php con la conexión a la base de datos

    $sql = "INSERT INTO convocatorias (tipo_convocatoria, nombre_convocatoria, archivo_convocatoria_nombre, archivo_convocatoria_tipo, archivo_convocatoria_binario) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);

    // Verifica si la preparación de la sentencia fue exitosa
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssssb', $tipo, $nameCon, $archivoCon_nombre, $archivoCon_tipo, $archivoCon_binario);
        mysqli_stmt_execute($stmt);

        // Verifica si la ejecución de la sentencia fue exitosa
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<script>alert('Se ha guardado la convocatoria con éxito');</script>";
        } else {
            echo "<script>alert('Ocurrió un problema al guardar la convocatoria');</script>";
        }

        // Cierra la sentencia preparada
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Ocurrió un problema al preparar la sentencia');</script>";
    }

    // Cierra la conexión a la base de datos
    mysqli_close($conexion);
}



?>
