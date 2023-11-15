<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <title>Document</title>
    <link rel="stylesheet" href="style_index.css">
</head>
<body>
    <form action="validar.php" method="post">
        <h1>Iniciar Sesión</h1>
        <p>Usuario <input type="text" placeholder="Ingrese su Correo" name="usuario" require></p>
        <p>Contraseña <input type="password" placeholder="Ingrese su contraseña" name="pass" require></p>
        <input type="submit" value="Ingresar" class="btn btn-successs">
    </form>
</body>
</html>