<?php

$servidor = 'mysql-crudutn.alwaysdata.net';
$usuario = 'crudutn';
$contrasena = 'matu424242';
$bd = 'crudutn_mateo';



$conexion = new mysqli($servidor, $usuario, $contrasena, $bd);

if ($conexion->connect_error) {

    die($conexion->connect_error);
}
