<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Mediciones</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/common.css">
    <link rel="stylesheet" href="./styles/eliminar.css">
</head>

<body>
    <?php include_once('cabecera.php'); ?>

    <div class="container">
        <div class="measures-container">
            <h2>Eliminar Mediciones</h2>
            <?php
            include_once('conexion.php');

            $sql = "SELECT m.id, u.name, meterId, measure, createdAt, image FROM Measures m JOIN Users u ON m.userId = u.id ORDER BY createdAt DESC";
            $resultado = $conexion->query($sql);

            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo '<div class="measure-item">';
                    echo '<div class="measure-image"><img src="' . $fila['image'] . '" alt="Captura"></div>';
                    echo '<div class="measure-content">';
                    echo '<h3>Usuario: ' . $fila['name'] . '</h3>';
                    echo '<div class="measure-details">';
                    echo '<div class="measure-info">';
                    echo "<p><strong>Medidor:</strong> " . $fila['meterId'] . "</p>";
                    echo "<p><strong>Medición:</strong> " . $fila['measure'] . "</p>";
                    echo '</div>';
                    echo '<form action="eliminarR.php" method="post">';
                    echo '<input type="hidden" name="id" value="' . $fila['id'] . '">';
                    echo '<button type="submit" class="delete-btn">Eliminar</button>';
                    echo '</form>';
                    echo '</div></div>';
                    echo '</div>';
                }
            } else {
                echo "<p class='no-records'>Sin registros encontrados en la base de datos</p>";
            }
            ?>
        </div>
    </div>
</body>

</html>