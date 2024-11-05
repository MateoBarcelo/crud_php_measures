<?php

include_once('conexion.php');

$id = $_POST['id'];

$sql = "DELETE FROM Measures WHERE id = '$id'";


if (
    $conexion->query($sql) === TRUE
) {
    echo "Registro eliminado correctamente";
} else {

    $conexion->error;
};

$conexion->close();

header('Location:eliminar.php');
