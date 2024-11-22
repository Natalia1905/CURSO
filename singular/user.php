
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inicio Sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Website Template by FreeHTML5.co" />
    <meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
    <meta name="author" content="FreeHTML5.co" />

    <link rel="shortcut icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro" rel="stylesheet">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <script src="js/modernizr-2.6.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Incluir Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

  
</head>
<body>
<?php
session_start();
include '../01component-form/php/conexion.php'; // Incluye el archivo de conexión a la base de datos

// Verifica si el usuario está logueado y tiene un ID de usuario en la sesión
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Obtén el ID del usuario

    // Prepara la consulta para obtener la foto y el género del usuario
    $query = "SELECT photo, genero FROM user WHERE id_user = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica si se encontró el usuario
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $foto_usuario = $row['photo']; // Obtiene la foto del usuario
        $genero = $row['genero']; // Obtiene el género del usuario

        // Verifica si la foto está vacía o es nula; si es así, asigna la predeterminada según el género
        if (empty($foto_usuario)) {
            // Imagen predeterminada según el género
            $foto_usuario = ($genero == 'mujer') ? 'images/person_2.jpg' : 'images/person_1.jpg';
        }

        // Asigna el estilo de fondo según el género
        $background_style = ($genero == 'mujer') ? 'background-image: url(images/polygon1.png);' : 'background-image: url(images/polygon.png);';
    } else {
        // Imagen predeterminada si no se encuentra el usuario
        $foto_usuario = 'images/person_2.jpg'; // Imagen para mujer por defecto
        $background_style = 'background-image: url(images/polygon.png);';
    }

    // Obtener el curso y el porcentaje de progreso en una sola consulta
    $cursoQuery = "SELECT c.id_curso, c.nombre_curso, pu.porcentaje FROM curso c
    JOIN progreso_usuario pu ON c.id_curso = pu.id_curso
    WHERE pu.id_user = ? AND pu.porcentaje < 99";
    $cursoStmt = $conn->prepare($cursoQuery);
    $cursoStmt->bind_param("i", $userId);
    $cursoStmt->execute();
    $cursoStmt->bind_result($idCurso, $nombre_curso, $porcentaje);
    $cursoStmt->fetch();
    $cursoStmt->close();

    // Verificar el módulo actual
    $moduloQuery = "SELECT CASE
                        WHEN leccion = 'off' THEN 'leccion'
                        WHEN ejercicio = 'off' THEN 'ejercicio'
                        WHEN juego = 'off' THEN 'juego'
                        WHEN video = 'off' THEN 'video'
                        WHEN evaluacion = 'off' THEN 'evaluacion'
                    END AS modulo
                    FROM progreso_usuario
                    WHERE id_user = ? AND id_curso = (SELECT id_curso FROM progreso_usuario WHERE id_user = ? AND porcentaje < 99 LIMIT 1)
                    HAVING modulo IS NOT NULL LIMIT 1";

    $moduloStmt = $conn->prepare($moduloQuery);
    $moduloStmt->bind_param("ii", $userId, $userId);
    $moduloStmt->execute();
    $moduloStmt->bind_result($modulo);
    $moduloStmt->fetch();
    $moduloStmt->close();

} else {
    // Si no hay sesión, asigna la imagen de mujer como predeterminada
    $foto_usuario = 'images/person_2.jpg'; // Imagen para mujer por defecto
    $background_style = 'background-image: url(images/polygon.png);';
}

$conn->close();
?>


<div id="fh5co-header" style="<?php echo $background_style; ?>" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="bio-photo text-center">
        <a href="user.php"><img id="user-photo" src="<?php echo htmlspecialchars($foto_usuario); ?>" alt="Foto del usuario" height="160" width="160"></a>
        <button id="edit-icon" style="border: none; background: none; cursor: pointer;">
            <img src="images/edit_icon.png" alt="Editar" height="40" width="40">
        </button>
    </div>
</div>
<div id="image-options" style="display: none; text-align: center; margin-top: 90px;">
    <h3 style="margin-bottom: 10px;">Elige una imagen</h3>
    <?php if ($genero == 'mujer'): ?>
        <img src="images/img_1.jpg" alt="Imagen 1" class="image-option" height="100" width="100" data-img-src="images/img_1.jpg" style="cursor: pointer; margin: 0 10px;">
        <img src="images/img_2.jpg" alt="Imagen 2" class="image-option" height="100" width="100" data-img-src="images/img_2.jpg" style="cursor: pointer; margin: 0 10px;">
    <?php elseif ($genero == 'hombre'): ?>
        <img src="images/img_3.jpg" alt="Imagen 3" class="image-option" height="100" width="100" data-img-src="images/img_3.jpg" style="cursor: pointer; margin: 0 10px;">
        <img src="images/img_4.jpg" alt="Imagen 4" class="image-option" height="100" width="100" data-img-src="images/img_4.jpg" style="cursor: pointer; margin: 0 10px;">
    <?php endif; ?>
</div>

<script>
    document.getElementById('edit-icon').addEventListener('click', function() {
        const options = document.getElementById('image-options');
        options.style.display = options.style.display === 'none' ? 'block' : 'none';
    });

    const imageOptions = document.querySelectorAll('.image-option');
    imageOptions.forEach(option => {
        option.addEventListener('click', function() {
            const imgSrc = this.getAttribute('data-img-src');
            document.getElementById('user-photo').src = imgSrc; // Cambiar la imagen del usuario
            document.getElementById('image-options').style.display = 'none'; // Ocultar opciones
            console.log('Imagen seleccionada:', imgSrc);

            // Enviar la nueva imagen al servidor
            fetch('../01component-form/php/cambio.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'photo=' + encodeURIComponent(imgSrc) // Enviar la ruta de la imagen
            })
            .then(response => response.text())
            .then(data => {
                console.log(data); // Muestra la respuesta del servidor
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>

<div id="fh5co-main">
    <div class="fh5co-section fh5co-works">
        <div class="container">
            <div class="row">
            <div class="container" style="display: flex; justify-content: flex-start; align-items: center;">
    <h1 style="margin-right: auto;">Hola, <?php echo $_SESSION['nombre']; ?>!</h1>
    <a href="../01component-form/php/logout.php" style="margin-left: auto;">
        <img src="images/exit.png" alt="Cerrar Sesión" style="width: 40px; height: 40px;"/> Salir<!-- Cambia la ruta según corresponda -->
    </a>
</div>


                <div class="fh5co-section">
                    <div class="container">
                        <div class="row">
                           
                        <div class="col-md-12 section-heading">
    <h2>CURSO ACTUAL:</h2>
</div>
<div class="col-md-12 course-card text-center">
    <?php if (isset($nombre_curso) && isset($modulo) && isset($idCurso)): ?>
        <a href="curso.php?id_curso=<?php echo urlencode($idCurso); ?>&modulo=<?php echo urlencode($modulo); ?>">
            <button class="course-button">Continuar curso: <?php echo htmlspecialchars($nombre_curso); ?></button>
        </a>
    <?php else: ?>
        <p>No hay curso asignado </p>
    <?php endif; ?>
</div>


<div class="col-md-12 section-heading">
    <h2>PROGRESO DEL CURSO</h2>
</div>
<div class="col-md-12 text-center">
    <canvas id="progressChart" width="400" height="200"></canvas>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('progressChart').getContext('2d');
        const porcentaje = <?php echo isset($porcentaje) ? $porcentaje : 0; ?>;

        const progressChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Progreso', 'Restante'],
                datasets: [{
                    data: [porcentaje, 100 - porcentaje],
                    backgroundColor: ['#36A2EB', '#FF6384'],
                    hoverBackgroundColor: ['#36A2EB', '#FF6384'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    datalabels: {
                        formatter: (value, ctx) => {
                            let sum = 0;
                            const dataArr = ctx.chart.data.datasets[0].data;
                            dataArr.map(data => {
                                sum += data;
                            });
                            const percentage = Math.round((value / sum) * 100);
                            return percentage + '%'; // Muestra el porcentaje
                        },
                        color: '#fff',
                    }
                }
            },
            plugins: [ChartDataLabels] // Agrega el plugin de etiquetas
        });
    });
</script>
                

<div class="col-md-12 section-heading"> 
    <h2>EXISTENTES</h2>
</div>
<div class="col-md-12 course-list">
    <?php
    // Conectar a la base de datos nuevamente si es necesario
    include '../01component-form/php/conexion.php';

    // Consulta para obtener los cursos según el criterio especificado
    $cursosQuery = "SELECT id_curso, nombre_curso FROM curso WHERE tipo_educativa = (SELECT educativa FROM user WHERE id_user = ?)";
    $cursosStmt = $conn->prepare($cursosQuery);
    $cursosStmt->bind_param("i", $userId);
    $cursosStmt->execute();
    $cursosResult = $cursosStmt->get_result();

    // Después de la consulta para obtener los cursos
$cursosQuery = "SELECT id_curso, nombre_curso FROM curso WHERE tipo_educativa = (SELECT educativa FROM user WHERE id_user = ?)";
$cursosStmt = $conn->prepare($cursosQuery);
$cursosStmt->bind_param("i", $userId);
$cursosStmt->execute();
$cursosResult = $cursosStmt->get_result();

// Verificar si el usuario tiene cursos en progreso y su porcentaje
$hayCursosEnProgreso = false;
$porcentajeCursoEnProgreso = null;

// Verificar si el usuario tiene cursos con porcentaje menor a 99
$queryProgreso = "SELECT COUNT(*) FROM progreso_usuario WHERE id_user = ? AND porcentaje < 99";
$stmtProgreso = $conn->prepare($queryProgreso);
$stmtProgreso->bind_param("i", $userId);
$stmtProgreso->execute();
$stmtProgreso->bind_result($countProgreso);
$stmtProgreso->fetch();
$stmtProgreso->close();

if ($countProgreso > 0) {
    $hayCursosEnProgreso = true;
}
// Mostrar los cursos que coinciden
if ($cursosResult->num_rows > 0) {
    while ($curso = $cursosResult->fetch_assoc()) {
        echo "<p>" . htmlspecialchars($curso['nombre_curso']) . "</p>";
        if ($hayCursosEnProgreso) {
            echo "<button onclick=\"alert('Debes terminar el curso para comenzar otro o reiniciarlo.');\">Comenzar</button>";
        } else {
            echo "<form action='iniciar_progreso.php' method='POST'>
                    <input type='hidden' name='id_curso' value='" . $curso['id_curso'] . "'>
                    <button type='submit'>Comenzar</button>
                  </form>";
        }
    }
} else {
    echo "<p>No hay cursos disponibles en esta categoría.</p>";
}



$cursosStmt->close();
    $conn->close();
    ?>
</div>


            </div>
        </div>
    </div>
</div>
</body>
</html>