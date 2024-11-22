<?php
session_start();
include '../01component-form/php/conexion.php';

// Eliminar las filas donde el 'status' es 'I'
$deleteQuery = "DELETE FROM progreso_usuario WHERE status = 'I'";
$conn->query($deleteQuery);

// Verifica si el usuario ha iniciado sesión y tiene un curso asignado
if (isset($_SESSION['user_id']) && isset($_POST['id_curso'])) {
    $userId = $_SESSION['user_id'];
    $idCurso = $_POST['id_curso'];

    // Obtener el valor de educativa del usuario de la tabla user
    $queryUser = "SELECT educativa FROM user WHERE id_user = ?";
    $stmtUser = $conn->prepare($queryUser);
    $stmtUser->bind_param("i", $userId);
    $stmtUser->execute();
    $stmtUser->bind_result($educativa);
    $stmtUser->fetch();
    $stmtUser->close();

    // Obtener el valor de curso de la tabla curso
    $queryCurso = "SELECT curso FROM curso WHERE id_curso = ?";
    $stmtCurso = $conn->prepare($queryCurso);
    $stmtCurso->bind_param("i", $idCurso);
    $stmtCurso->execute();
    $stmtCurso->bind_result($cursoCurso);
    $stmtCurso->fetch();
    $stmtCurso->close();

    // Insertar un nuevo registro en progreso_usuario con el estado inicial, el valor de tipo_educativo, y el valor de curso
    $queryProgreso = "INSERT INTO progreso_usuario (id_user, id_curso, tipo_educativo, leccion, ejercicio, juego, video, evaluacion, porcentaje, curso)
                      VALUES (?, ?, ?, 'off', 'off', 'off', 'off', 'off', 0, ?)";
    $stmtProgreso = $conn->prepare($queryProgreso);
    $stmtProgreso->bind_param("iiss", $userId, $idCurso, $educativa, $cursoCurso);
    $stmtProgreso->execute();
    $stmtProgreso->close();

    // Redirigir a curso.php
    header("Location: curso.php?id_curso=" . $idCurso);
    exit;
} else {
    // Si no está autenticado, redirige a iniciar sesión
    header("Location: iniciar_sesion.html");
    exit;
}
?>
