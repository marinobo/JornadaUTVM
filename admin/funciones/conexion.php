<?php
$mysqli = new mysqli(
    "localhost",
    "root",
    "",
    "jornadaUTVM"
);

if ($mysqli->connect_errno) {
    die("Algo salio mal");
}else {
}

?>