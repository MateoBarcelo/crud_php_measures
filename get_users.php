<?php
include_once('conexion.php');

header('Content-Type: application/json');

$sql = "SELECT id, name FROM Users ORDER BY name";
$resultado = $conexion->query($sql);

$users = array();
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $users[] = $row;
    }
}

echo json_encode($users);

$conexion->close(); 