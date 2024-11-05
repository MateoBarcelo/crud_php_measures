<?php
include_once('conexion.php');

try {
    // Validación de datos recibidos
    if (!isset($_POST['userId']) || !isset($_POST['medidor']) || !isset($_POST['medicion']) || !isset($_POST['capturaBase64'])) {
        throw new Exception('Error: Asegurate que todos los campos esten completos');
    }

    $userId = $_POST['userId'];
    $meterId = $_POST['medidor'];
    $measure = $_POST['medicion'];
    $image = $_POST['capturaBase64'];

    if (empty($image)) {
        throw new Exception('Error: No se recibió ninguna imagen');
    }

    // Verificar si existe el usuario
    $checkUser = "SELECT id FROM Users WHERE id = ?";
    $stmt = $conexion->prepare($checkUser);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        throw new Exception('Error: El ID de usuario especificado no existe');
    }

    $sql = "INSERT INTO Measures(userId, meterId, measure, image) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("isss", $userId, $meterId, $measure, $image);
    
    if ($stmt->execute()) {
        echo "<script>
                window.location.href = 'index.php';
              </script>";
    } else {
        throw new Exception('Error al insertar el registro: ' . $stmt->error);
    }

} catch (Exception $e) {
    echo "<script>
            alert('" . $e->getMessage() . "');
            window.location.href = 'index.php';
          </script>";
} finally {
    if (isset($stmt)) {
        $stmt->close();
    }
    if (isset($conexion)) {
        $conexion->close();
    }
}
?>
