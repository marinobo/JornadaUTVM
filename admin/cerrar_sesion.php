<?php
session_start(); // Inicia la sesión

// Destruye todas las variables de sesión
session_unset();
// Destruye la sesión
session_destroy();

// Redirecciona al usuario a la página de inicio de sesión o a donde desees
header("Location: index.php");
exit();
?>
