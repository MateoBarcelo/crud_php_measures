<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Mediciones</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/common.css">
    <link rel="stylesheet" href="./styles/actualizar.css">
</head>

<body>
    <?php include_once('cabecera.php'); ?>

    <div class="container">
        <div class="measures-container">
            <h2>Actualizar Mediciones</h2>
            <?php
            include_once('conexion.php');

            $sql = "SELECT m.id, u.name, meterId, measure, createdAt, image FROM Measures m JOIN Users u ON m.userId = u.id ORDER BY createdAt DESC";
            $resultado = $conexion->query($sql);

            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    ?>
                    <div class="measure-item">
                        <div class="measure-image">
                            <img src="<?php echo $fila['image']; ?>" alt="Captura">
                        </div>
                        <div class="measure-content">
                            <h3>Usuario: <?php echo $fila['name']; ?></h3>
                            <form action="actualizarR.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                                <div class="measure-info">
                                    <div class="form-group">
                                        <label>Medidor:</label>
                                        <input type="text" name="meterId" value="<?php echo $fila['meterId']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Medición:</label>
                                        <input type="text" name="measure" value="<?php echo $fila['measure']; ?>">
                                    </div>
                                    <div class="measure-date">
                                        <span><?php echo $fila['createdAt']; ?></span>
                                        <button type="submit">Actualizar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>Sin registros encontrados en la base de datos</p>";
            }
            ?>
        </div>
    </div>
</body>

</html>