<?php
// Conexion a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cursomate";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Recibir datos del formulario
$correo = $_POST['correo'];
$contrase = $_POST['contrase'];

// Preparar la consulta
$sql = "SELECT * FROM user WHERE correo = ? AND contrase = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $correo, $contrase);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si hay un usuario con esos datos
if ($result->num_rows > 0) {
    // Autenticación exitosa
    $user = $result->fetch_assoc();
    // Guardar información del usuario en la sesión
    session_start();
    $_SESSION['user_id'] = $user['id_user'];
    $_SESSION['nombre'] = $user['nombre'];
    // Redirigir a la cuenta del usuario
    header("Location: ../../singular/user.php");
    exit();
} else {
    // Si no se encuentra el usuario, redirigir de vuelta con error
    echo "<script>alert('Correo o contraseña incorrectos.'); window.location.href='../inicio_sesion.html';</script>";
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
