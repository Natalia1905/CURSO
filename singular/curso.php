<!DOCTYPE html>
<html>
<head>
    <title>Curso</title>
    
</head>
<body>
<?php
session_start();
include '../01component-form/php/conexion.php';

// Verificar si el usuario y el curso están en la sesión
if (!isset($_SESSION['user_id']) || !isset($_GET['id_curso'])) {
    header("Location: iniciar_sesion.html");
    exit;
}

$moduloInicial = isset($_GET['modulo']) ? $_GET['modulo'] : 'leccion';
$userId = $_SESSION['user_id'];
$idCurso = $_GET['id_curso'];

// Consultar el tipo educativo y curso del usuario
$query = "SELECT tipo_educativo, curso FROM progreso_usuario WHERE id_user = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$tipoEducativo = $row['tipo_educativo'];
$curso = $row['curso'];

// Definir contenido personalizado según el tipo educativo y curso
$contenido = [
    'sindrome_down' => [
        '1' => [
            'leccion' => 'Contenido especial para síndrome de Down en la lección curso 1...',
            'ejercicio' => 'Ejercicios para curso 1 y síndrome de Down...',
            'juego' => 'Juego interactivo para curso 1 y síndrome de Down...',
            'video' => 'Video para curso 1 y síndrome de Down...',
            'evaluacion' => 'Evaluación adaptada para curso 1 y síndrome de Down...'
        ],
        '2' => [
            'leccion' => 'Contenido especial para síndrome de Down en la lección curso 2...',
            'ejercicio' => 'Ejercicios para curso 2 y síndrome de Down...',
            'juego' => 'Juego interactivo para curso 2 y síndrome de Down...',
            'video' => 'Video para curso 2 y síndrome de Down...',
            'evaluacion' => 'Evaluación adaptada para curso 2 y síndrome de Down...'
        ],
        '3' => [
            'leccion' => 'Contenido especial para síndrome de Down en la lección curso 3...',
            'ejercicio' => 'Ejercicios para curso 3 y síndrome de Down...',
            'juego' => 'Juego interactivo para curso 3 y síndrome de Down...',
            'video' => 'Video para curso 3 y síndrome de Down...',
            'evaluacion' => 'Evaluación adaptada para curso 3 y síndrome de Down...'
        ]
    ],
    'sensorial_auditiva' => [
        '1' => [
            'leccion' => 'Contenido para discapacidad auditiva en curso 1...',
            'ejercicio' => 'Ejercicios para curso 1 y discapacidad auditiva...',
            'juego' => 'Juego para curso 1 y discapacidad auditiva...',
            'video' => 'Video para curso 1 y discapacidad auditiva...',
            'evaluacion' => 'Evaluación para curso 1 y discapacidad auditiva...'
        ],
        '2' => [
            'leccion' => 'Contenido para discapacidad auditiva en curso 2...',
            'ejercicio' => 'Ejercicios para curso 2 y discapacidad auditiva...',
            'juego' => 'Juego para curso 2 y discapacidad auditiva...',
            'video' => 'Video para curso 2 y discapacidad auditiva...',
            'evaluacion' => 'Evaluación para curso 2 y discapacidad auditiva...'
        ],
        '3' => [
            'leccion' => 'Contenido para discapacidad auditiva en curso 3...',
            'ejercicio' => 'Ejercicios para curso 3 y discapacidad auditiva...',
            'juego' => 'Juego para curso 3 y discapacidad auditiva...',
            'video' => 'Video para curso 3 y discapacidad auditiva...',
            'evaluacion' => 'Evaluación para curso 3 y discapacidad auditiva...'
        ]
    ],
    'ninguna' => [
        '1' => [
            'leccion' => 'Contenido general de la lección para curso 1...',
            'ejercicio' => 'Ejercicios generales para curso 1...',
            'juego' => 'Juego interactivo general para curso 1...',
            'video' => 'Video educativo general para curso 1...',
            'evaluacion' => 'Evaluación general para curso 1...'
        ],
        '2' => [
    'leccion' => <<<HTML
<head>
        
        <!-- Animate.css -->
        <link rel="stylesheet" href="lecciones/normal/curso2/css/animate.css">
        <!-- Icomoon Icon Fonts-->
        <link rel="stylesheet" href="lecciones/normal/curso2/css/icomoon.css">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="lecciones/normal/curso2/css/bootstrap.css">
        <!-- Magnific Popup -->
        <link rel="stylesheet" href="lecciones/normal/curso2/css/magnific-popup.css">
        <!-- Flexslider -->
        <link rel="stylesheet" href="lecciones/normal/curso2/css/flexslider.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="lecciones/normal/curso2/css/style.css">

        <!-- Modernizr JS -->
        <script src="lecciones/normal/curso2/js/modernizr-2.6.2.min.js"></script>
   
    </head>
    <body>
        <div class="fh5co-loader"></div>

        <aside id="fh5co-hero" class="js-fullheight">
            <div class="flexslider js-fullheight">
                <ul class="slides">
                    <li style="background-image: url(lecciones/normal/curso2/images/img_bg_1.jpg);">
                        <div class="overlay-gradient"></div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3 col-md-pull-3 js-fullheight slider-text slider-text-bg">
                                    <div class="slider-text-inner">
                                        <h1>SUMA Y RESTA</h1>
                                        <h2 style="font-size: 14px;"><b>La suma es</b> cuando juntamos o añadimos cosas. Es una forma de contar cuántos objetos hay en total cuando los ponemos juntos. <br><b>La resta es </b>cuando quitamos o sacamos cosas. Es una forma de contar cuántos objetos quedan después de quitar algunos.</h2>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li style="background-image: url(lecciones/normal/curso2/images/img_bg_2.jpg);">
                        <div class="overlay-gradient"></div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3 col-md-pull-3 js-fullheight slider-text slider-text-bg">
                                    <div class="slider-text-inner">
                                        <h1>MULTIPLICACIÓN</h1>
                                        <h2 style="font-size: 14px;"><b>La multiplicación es </b>una forma rápida de sumar varias veces el mismo número. Es como hacer sumas repetidas, pero de manera más fácil y rápida.</h2>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li style="background-image: url(lecciones/normal/curso2/images/img_bg_3.jpg);">
                        <div class="overlay-gradient"></div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3 col-md-pull-3 js-fullheight slider-text slider-text-bg">
                                    <div class="slider-text-inner">
                                        <h1>DIVISIÓN</h1>
                                        <h2 style="font-size: 14px;">Cuando hacemos una división, estamos dividiendo un grupo de cosas en partes iguales, es decir, que cada parte tiene exactamente la misma cantidad.</h2>
                                        
        <button onclick="siguienteModulo('leccion', 'ejercicio')">Siguiente</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>   
                </ul>
            </div>
        </aside>

        <div class="gototop js-top">
            <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
        </div>

        <!-- jQuery -->
        <script src="lecciones/normal/curso2/js/jquery.min.js"></script>
        <!-- jQuery Easing -->
        <script src="lecciones/normal/curso2/js/jquery.easing.1.3.js"></script>
        <!-- Bootstrap -->
        <script src="lecciones/normal/curso2/js/bootstrap.min.js"></script>
        <!-- Waypoints -->
        <script src="lecciones/normal/curso2/js/jquery.waypoints.min.js"></script>
        <!-- Flexslider -->
        <script src="lecciones/normal/curso2/js/jquery.flexslider-min.js"></script>
        <!-- Magnific Popup -->
        <script src="lecciones/normal/curso2/js/jquery.magnific-popup.min.js"></script>
        <script src="lecciones/normal/curso2/js/magnific-popup-options.js"></script>
        <!-- Main -->
        <script src="lecciones/normal/curso2/js/main.js"></script>

HTML,
   'ejercicio' => <<<HTML

<head>
<style>

        iframe {
            width: 800px;
            height: 900px;
            border: none;
            margin-top: 100px;
        }
    </style>
</head>
    <iframe src="index.php" id="iframe" scrolling="no"><button onclick="siguienteModulo('ejercicio', 'juego')">Siguiente</button></iframe>
    

HTML,

    'juego' => <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory Game</title>
    <link rel="stylesheet" href="juegos/normal/curso2/css/style.css">
</head>
<body>
    <div class="gameInfo">
      <div id="moveCounter">Moves: 0</div>
      <div id="timer">Time: 00:00</div>
    </div>
    <div class="memory-game">

    </div>
    <button id="resetButton">Reset</button>
    <div class="winning-message" id="winningMessage">You won!</div>
    <script src="juegos/normal/curso2/js/main.js"></script>
</body>
</html>
HTML,

        'video' => <<<HTML
        
                <div id="fh5co-content">
                <div class="video fh5co-video" style="background-image: url(images/video.jpg);">
                    <a href="https://vimeo.com/channels/staffpicks/93951774" class="popup-vimeo"><i class="icon-video2"></i></a>
                    <div class="overlay"></div>
                </div>
                <div class="choose animate-box">
                    <div class="fh5co-heading">
                        <h2><B>VIDEO COMPLEMENTARIO</B></h2>
                    </div>
                </div>
            </div>
        
        HTML,

        'evaluacion' => <<<HTML

<head>
<style>

        iframe {
            width: 800px;
            height: 900px;
            border: none;
            margin-top: 100px;
        }
    </style>
</head>
    <iframe src="index.php" id="iframe" scrolling="no"><button onclick="siguienteModulo('ejercicio', 'juego')">Siguiente</button></iframe>
    

HTML,
        ],
        '3' => [
            'leccion' => 'Contenido general de la lección para curso 3...',
            'ejercicio' => 'Ejercicios generales para curso 3...',
            'juego' => 'Juego interactivo general para curso 3...',
            'video' => 'Video educativo general para curso 3...',
            'evaluacion' => 'Evaluación general para curso 3...'
        ]
    ]
];
?>
<!-- Rest of the HTML content remains the same -->
<div class="tab-container">
    <!-- Lección -->
    <div class="tab" id="leccion" style="<?php echo $moduloInicial == 'leccion' ? '' : 'display:none;'; ?>">
        <h2>Lección</h2>
        <p><?php echo $contenido[$tipoEducativo][$curso]['leccion']; ?></p>
        <button onclick="siguienteModulo('leccion', 'ejercicio')">Siguiente</button>
        <form action="user.php" method="GET">
                                <button type="submit">Home</button>
    </form>
    </div>

    <!-- Ejercicio -->
    <div class="tab" id="ejercicio" style="<?php echo $moduloInicial == 'ejercicio' ? '' : 'display:none;'; ?>">
        <h2>Ejercicio</h2>
        <p><?php echo $contenido[$tipoEducativo][$curso]['ejercicio']; ?></p>
        <button onclick="siguienteModulo('ejercicio', 'juego')">Siguiente</button>
        <form action="user.php" method="GET">
                                <button type="submit">Home</button>
    </form>
    </div>

    <!-- Juego -->
    <div class="tab" id="juego" style="<?php echo $moduloInicial == 'juego' ? '' : 'display:none;'; ?>">
        <h2>Juego</h2>
        <p><?php echo $contenido[$tipoEducativo][$curso]['juego']; ?></p>
        <button onclick="siguienteModulo('juego', 'video')">Siguiente</button>
        <form action="user.php" method="GET">
                                <button type="submit">Home</button>
    </form>
        
    </div>

    <!-- Video -->
    <div class="tab" id="video" style="<?php echo $moduloInicial == 'video' ? '' : 'display:none;'; ?>">
        <h3>¡Estás muy cerca de lograrlo! 🎉</h3>
        <p><?php echo $contenido[$tipoEducativo][$curso]['video']; ?></p>
        <button onclick="siguienteModulo('video', 'evaluacion')">Siguiente</button>
        <form action="user.php" method="GET">
                                <button type="submit">Home</button>
    </form>
    </div>

    <!-- Evaluación -->
    <div class="tab" id="evaluacion" style="<?php echo $moduloInicial == 'evaluacion' ? '' : 'display:none;'; ?>">
        <h2>Evaluación</h2>
        <p><?php echo $contenido[$tipoEducativo][$curso]['evaluacion']; ?></p>
        <button onclick="finalizarCurso()">Finalizar</button>
        <form action="user.php" method="GET">
        <button type="submit">Home</button>
    </div>
</div>
<script>
function siguienteModulo(actual, siguiente) {
    fetch(`actualizar_progreso.php?modulo=${actual}&id_curso=<?php echo $idCurso; ?>`)
        .then(response => response.text())
        .then(data => console.log(data))
        .catch(error => console.error('Error:', error));

    document.getElementById(actual).style.display = 'none';
    document.getElementById(siguiente).style.display = 'block';
}
function finalizarCurso() {
    fetch(`actualizar_progreso.php?modulo=evaluacion&id_curso=<?php echo $idCurso; ?>`)
        .then(response => response.text())
        .then(data => {
            console.log(data);
            window.location.href = 'gracias.php';
        })
        .catch(error => console.error('Error:', error));
}
</script>
</body>
</html>
