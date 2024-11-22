<?php
session_start();
include 'conexion.php'; // Asegúrate de incluir el archivo de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $photo = $_POST['photo'];
    $userId = $_SESSION['user_id']; // Asegúrate de tener el ID del usuario

    // Asegúrate de que la conexión a la base de datos esté bien establecida
    $query = "UPDATE user SET photo = ? WHERE id_user = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $photo, $userId);

    if ($stmt->execute()) {
        echo "Imagen actualizada correctamente.";
    } else {
        echo "Error al actualizar la imagen: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
