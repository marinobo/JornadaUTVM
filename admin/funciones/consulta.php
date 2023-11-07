<?php
    require 'conexion.php';

    if (!$mysqli) {
        # code...
        die('NO SE PUEDE CONECTAR A BASE DE DATOS');
    }

    $usuario = utf8_decode($_POST['usuario']);
    $pass = utf8_decode($_POST['pass']);
    $contodar =0;

    if (isset($_POST["btniniciar"])) {
        # code...
        if (password_verify($password, $query['pass'] )){
            $contodar++;
        }
        $query = mysqli_query($mysqli, "SELECT * FROM loginAdmin¡ WHERE usuario = '$usuario' AND pass = '$pass'");
        $nr = mysqli_num_rows($query);
        if ($nr==1) {
            echo "<script> alert('Bienvenido: $usuario'); window.location='index.html'</script>";
        }else {
            echo "<script> alert('El usuario no existe'); window.location='login.html'</script>";
        }
    }