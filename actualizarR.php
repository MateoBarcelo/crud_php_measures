<?php

include_once('conexion.php');
//actualizar registros


$id = $_POST['id'];
$meterId = $_POST['meterId'];
$measure = $_POST['measure'];



$sql = "UPDATE Measures SET meterId = '$meterId' , measure = '$measure' WHERE id = '$id'";

if (
    $conexion->query($sql) === TRUE
) {
    echo "Registro actualizado correctamente";
} else {

    $conexion->error;
};

$conexion->close();

header('Location:index.php');
