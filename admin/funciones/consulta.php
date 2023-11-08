<?php
    // Conexión a la base de datos
    $conn = mysqli_connect('localhost', 'root', '', 'jornadaUTVM');

    // Recuperar los datos del formulario de inicio de sesión
    $usuario = $_POST['usuario'];
    $pass = $_POST['pass'];

    // Consulta para verificar las credenciales del usuario
    $query = "SELECT * FROM loginAdmin WHERE usuario='$usuario' AND pass='$pass'";
    $result = mysqli_query($conn, $query);

    // Verificar si se encontraron coincidencias en la base de datos
    if (mysqli_num_rows($result) == 1) {
        // Credenciales válidas, iniciar sesión
        session_start();
        $_SESSION['username'] = $username;
        // Redirigir al usuario a la página de inicio
        header('Location: index.html');
    } else {
        // Credenciales inválidas, mostrar mensaje de error
        echo "Nombre de usuario o contraseña incorrectos.";
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
    
?>