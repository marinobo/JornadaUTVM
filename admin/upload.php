<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $targetDirectory = "uploads/";  // Directorio donde se guardarán los archivos
    $targetFile = $targetDirectory . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Verificar si el archivo ya existe
    if (file_exists($targetFile)) {
        echo "El archivo ya existe.";
        $uploadOk = 0;
    }

    // Verificar el tamaño del archivo (opcional)
    if ($_FILES["file"]["size"] > 5000000) { // 5 MB
        echo "El archivo es demasiado grande.";
        $uploadOk = 0;
    }

    // Permitir solo ciertos tipos de archivos (puedes personalizar esto)
    $allowedFileTypes = array("pdf", "doc", "docx", "txt");
    if (!in_array($fileType, $allowedFileTypes)) {
        echo "Solo se permiten archivos PDF, DOC, DOCX y TXT.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "La carga del archivo ha fallado.";
    } else {
        // Mover el archivo al directorio de destino
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            echo "El archivo " . basename($_FILES["file"]["name"]) . " ha sido subido correctamente.";
        } else {
            echo "Hubo un error al subir el archivo.";
        }
    }
}
?>