<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Mediciones</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/common.css">
    <link rel="stylesheet" href="estilos.css">
</head>

<body>

    <?php
    include_once('cabecera.php');
    ?>

    <div class="container">
        <div class="form-container">
            <div class="card">
                <h2>Registrar mediciones</h2>
                <form action="insertar.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="userId">ID Usuario</label>
                        <input type="text" 
                               id="userId" 
                               name="userId" 
                               list="usersList" 
                               required>
                        <datalist id="usersList">
                        </datalist>
                    </div>

                    <div class="form-group">
                        <label for="medidor">Medidor</label>
                        <input type="text" id="medidor" name="medidor" required>
                    </div>

                    <div class="form-group">
                        <label for="medicion">Medición</label>
                        <input type="text" id="medicion" name="medicion" required>
                    </div>

                    <div class="form-group">
                        <label for="captura">Captura</label>
                        <input type="file" 
                               id="captura" 
                               name="captura" 
                               accept="image/*" 
                               required 
                               onchange="convertToBase64()">
                        <input type="hidden" id="capturaBase64" name="capturaBase64">
                    </div>

                    <button type="submit">Registrar Medición</button>
                </form>
            </div>
        </div>
        
        <div class="measures-container">
            <h2>Mediciones Registradas</h2>
            <?php
                include_once('conexion.php');

            $sql = "SELECT m.id, u.name, meterId, measure, 
                    DATE_FORMAT(CONVERT_TZ(createdAt, '+00:00', '-04:00'), '%d/%m/%Y %H:%i:%s') as createdAt, 
                    image 
                    FROM Measures m 
                    JOIN Users u ON m.userId = u.id 
                    ORDER BY createdAt DESC";
            $resultado = $conexion->query($sql);

            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo '<div class="measure-item">';
                    echo '<div class="measure-image"><img src="' . $fila['image'] . '" alt="Captura"></div>';
                    echo '<div class="measure-content">';
                    echo '<h3>Captura Registrada</h3>';
                    echo '<div class="measure-details">';
                    echo '<div class="measure-info">';
                    echo "<p><strong>Medidor:</strong> " . $fila['meterId'] . "</p>";
                    echo "<p><strong>Medición:</strong> " . $fila['measure'] . "</p>";
                    echo '</div>';
                    echo '<div class="measure-date">' . $fila['createdAt'] . '</div>';
                    echo '</div></div>';
                    echo '</div>';
                }
            } else {
                echo "<p>Sin registros encontrados en la base de datos</p>";
            }
            ?>
        </div>
    </div>

    <?php
    include_once('conexion.php');

    ?>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('get_users.php')
            .then(response => response.json())
            .then(users => {
                const usersList = document.getElementById('usersList');
                usersList.innerHTML = '';
                users.forEach(user => {
                    const option = document.createElement('option');
                    option.value = user.id;
                    option.label = `${user.id} - ${user.name}`;
                    usersList.appendChild(option);
                });
            })
            .catch(error => console.error('Error:', error));
    });

    function convertToBase64() {
        const file = document.querySelector('#captura').files[0];
        const reader = new FileReader();
        
        reader.onloadend = function() {
            document.querySelector('#capturaBase64').value = reader.result;
        }
        
        if (file) {
            reader.readAsDataURL(file);
        }
    }
    </script>

</body>

</html>