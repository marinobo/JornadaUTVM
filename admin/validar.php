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
    header("location:guardar.php");
}else {
    ?>
    <?php
    include("index.php");
    ?><script>alert('ERROR EN LA AUTENTIFICACION');</script>"
    <?php
}
mysqli_free_result($resultado);
mysqli_close($conexion);
?>
