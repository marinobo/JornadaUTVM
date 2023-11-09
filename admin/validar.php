<?php

$usuario = $_POST['usuario'];
$pass = $_POST['pass'];
session_start();
$_SESSION['usuario']=$usuario;

include('db.php');

$consulta="SELECT*FROM loginAdmin where usuario='$usuario' and pass='$pass'";
$resultado=mysqli_query($conexion, $consulta);

$filas=mysqli_num_rows($resultado);

if ($filas) {
    header("location:home.php");
}else {
    ?>
    <?php
    include("index.php");
    ?>
    <h1>ERROR EN LA AUTENTIFICACION</h1>
    <?php
}
mysqli_free_result($resultado);
mysqli_close($conexion);
