<?php
session_start();
include '../01component-form/php/conexion.php';

if (isset($_SESSION['user_id']) && isset($_GET['modulo']) && isset($_GET['id_curso'])) {
    $userId = $_SESSION['user_id'];
    $modulo = $_GET['modulo'];  // El módulo que se está actualizando (lección, ejercicio, etc.)
    $idCurso = $_GET['id_curso'];

    // Verificar el tipo educativo del usuario
    $queryTipoEducativo = "SELECT tipo_educativo FROM progreso_usuario WHERE id_user = ? AND id_curso = ?";
    $stmtTipoEducativo = $conn->prepare($queryTipoEducativo);
    $stmtTipoEducativo->bind_param("ii", $userId, $idCurso);
    $stmtTipoEducativo->execute();
    $result = $stmtTipoEducativo->get_result();
    
    if ($result->num_rows > 0) {
        $tipoEducativo = $result->fetch_assoc()['tipo_educativo'];
        $stmtTipoEducativo->close();

        // Asegurarse de que el tipo educativo sea uno de los tres posibles
        if (in_array($tipoEducativo, ['sindrome_down', 'sensorial_auditiva', 'ninguna'])) {
            // Actualiza el estado del módulo correspondiente a "on"
            $query = "UPDATE progreso_usuario SET $modulo = 'on' WHERE id_user = ? AND id_curso = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $userId, $idCurso);
            $stmt->execute();
            $stmt->close();
            
            // Responder con un mensaje de éxito
            echo "Progreso actualizado para el módulo $modulo del tipo educativo $tipoEducativo";
        } else {
            // Si el tipo educativo no es válido
            echo "Error: Tipo educativo no válido.";
        }
    } else {
        // Si no se encuentra el usuario o curso en la base de datos
        echo "Error: Usuario o curso no encontrado.";
    }
} else {
    echo "Error en la solicitud: Parámetros incompletos.";
}
?>
