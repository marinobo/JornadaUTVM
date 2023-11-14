<?php

// Actividades
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnGuardarAct']))
{
    // Recupera los datos del formulario
    $dia = $_POST['dia'];
    $nameAct = $_POST['nameAct'];
    $asist = $_POST['asist'];
    $fecha = $_POST['fecha'];
    $horaAct = $_POST['horaAct'];
    $PonCord = $_POST['PonCord'];
    $ResAct = $_POST['ResAct'];
    
    // Luego, puedes guardar los datos en la base de datos
    include('db.php'); // Asegúrate de tener un archivo db.php con la conexión a la base de datos
    
    $sql = "INSERT INTO actividades (dia, nombre_actividad, asistentes, hora_actividad, ponente_coordinador, responsables) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);
    
    // Verifica si la preparación de la sentencia fue exitosa
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, 'ssssss', $dia, $nameAct, $asist, $horaAct, $PonCord, $ResAct);
        mysqli_stmt_execute($stmt);
        
        // Verifica si la ejecución de la sentencia fue exitosa
        if (mysqli_stmt_affected_rows($stmt) > 0)
        {
            echo "<script>
            alert('Se ha guardado la actividad con éxito');
            window.location.href = 'guardar.php';
            </script>";
            exit;
        } else
        {
            echo "<script>alert('Ocurrió un problema al guardar la actividad');</script>";
        }
        
        // Cierra la sentencia preparada
        mysqli_stmt_close($stmt);
    } else
    {
        echo "<script>alert('Ocurrió un problema al preparar la sentencia');</script>";
    }
    
    // Cierra la conexión a la base de datos
    mysqli_close($conexion);
}

?>
