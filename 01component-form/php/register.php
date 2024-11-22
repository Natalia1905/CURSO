<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Obtener y sanitizar los datos del formulario
$genero = isset($_POST['genero']) ? $conn->real_escape_string($_POST['genero']) : '';
$nombre = isset($_POST['nombre']) ? $conn->real_escape_string($_POST['nombre']) : '';
$nom_completo = isset($_POST['nom_completo']) ? $conn->real_escape_string($_POST['nom_completo']) : '';
$correo = isset($_POST['correo']) ? $conn->real_escape_string($_POST['correo']) : '';
$contrase = isset($_POST['contrase']) ? $conn->real_escape_string($_POST['contrase']) : ''; // Almacena la contraseña tal cual
$fecha_creacion = date("Y-m-d");

// Procesar la necesidad educativa especial seleccionada
$educativa = isset($_POST['educativa']) ? $conn->real_escape_string($_POST['educativa']) : 'ninguna';

// Validar campos necesarios antes de proceder
if (empty($genero) || empty($nombre) || empty($nom_completo) || empty($correo) || empty($contrase)) {
    echo "<script>alert('Por favor, completa todos los campos requeridos.'); window.history.back();</script>";
    exit;
}

// Validar formato del correo electrónico
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('El formato del correo electrónico es inválido.'); window.history.back();</script>";
    exit;
}

// Insertar datos en la base de datos
$sql = "INSERT INTO user (genero, nombre, nom_completo, educativa, correo, contrase, fecha_creacion) 
        VALUES ('$genero', '$nombre', '$nom_completo', '$educativa', '$correo', '$contrase', '$fecha_creacion')";

if ($conn->query($sql) === TRUE) {
    // Registro exitoso: mostrar mensaje y redirigir
    echo "<script>
            alert('Registro exitoso.');
            window.location.href = '../inicio_sesion.html';
          </script>";
} else {
    // Error al insertar, mostrar el error
    echo "<script>alert('Error: " . $conn->error . "'); window.history.back();</script>";
    echo "Error en la consulta: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
