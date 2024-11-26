<?php

include('../libreria/juego/listarPreguntas.php');

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('../principal/head.php'); ?>
    <link rel="stylesheet" href="../css/estilosJuego.css" />
    <link rel="stylesheet" href="../css/dioses.css" />
</head>

<body class="pantano">
    <div class="container">
        <!-- Columna para la pregunta y chat -->
        <div class="row">
            <div class="col-8  mt-1">
                <div class="woodquest mt-2 ">
                    <?php
                    // Verificar el resultado de la consulta 
                    if (count($resultado) > 0) {
                        // Obtener la pregunta aleatoria
                        $pregunta = $resultado[0];
                        echo '<h1 class="pregunta-texto  text-center">' . $pregunta['pregunta'] . '</h1>';

                        // Agregar la pregunta a la lista de preguntas ya mostradas
                        // $_SESSION['preguntas_mostradas'][] = $pregunta['pregunta_id'];
                    } else {
                        echo '<h1 class="pregunta-texto text-center">No hay más preguntas disponibles</h1>';
                    }
                    ?>
                </div>
            </div>
            <div class="col-1"></div>
            <div class="col-3">
                <div class="contenedor-botones mt-1">
                    <!-- <div class="terminaste "></div> -->
                    <div class="listo text-center " id="validateButton"></div>
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="col-8  pergaminove">
                <div class="text-center " id="dropzone"></div>
            </div>
            <div class="col-1 "></div>

            <!-- chat -->
            <div class="col-3 chat mt-2 border rounded p-2">
                <div class="text-center mb-2">
                    <div class="basi"></div>
                </div>
                <div class="messages  mb-3" id="messages"></div>
                <div class="send-message d-flex">
                    <input type="text" class="form-control me-2" id="message">
                    <button class="btn btn-primary" type="button" id="send">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="col-8  tablajuego rounded" id="drag-container">
                <!-- Aquí se generarán los elementos de los dioses aleatoriamente -->
            </div>
            <div class="col-4 ">
            </div>
        </div>
    </div>

    <iframe id="musicaIframe" src="../musica/musicaJuego.html" allow="autoplay" style="display:none;"></iframe>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../js/dragdrop.js"></script>
    <script src="../js/socket/socket.js"></script>
    <script src="../js/generarDioses.js"></script>
    <script src="../js/devolverDrag.js"></script>
    <script src="../js/validacionDioses.js"></script>
</body>

</html>