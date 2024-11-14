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
        <!-- Row superior para la imagen -->
        <div class="row mb-3">
            <div class="col-12 text-center">
                <div class="imagen-superior"></div>
            </div>
        </div>

        <div class="row">
            <!-- Columna para el dropzone -->
            <div class="col-lg-9 col-md-8 col-sm-12">
                <div class="woodquest text-center ">
                    <h2 class="pregunta-texto text-center">
                        <?php
                        // Verificar el resultado de la consulta
                        if (count($resultado) > 0) {
                            // Obtener la pregunta aleatoria
                            $pregunta = $resultado[0];
                            echo '¿' . $pregunta['pregunta'] . '?';

                            // Agregar la pregunta a la lista de preguntas ya mostradas
                            $_SESSION['preguntas_mostradas'][] = $pregunta['pregunta_id'];
                        } else {
                            echo "No hay más preguntas disponibles";
                        }
                        ?>
                    </h2>
                </div>
                <div class="item4" id="dropzone">
                    <div class="pergaminove"></div>
                </div>
                <div class="col-12 pt-3">
                    <div class="tablajuego container" id="drag-container">
                        <!-- Aquí se generarán los elementos de los dioses aleatoriamente -->
                    </div>
                </div>
            </div>

            <!-- Columna de chat -->
            <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="chat container border rounded p-2 justify-content-start">
                    <div class="text-center mb-2">
                        <div class="basi"></div>
                    </div>
                    <div class="messages p-3 mb-3" id="messages"></div>
                    <div class="send-message d-flex">
                        <input type="text" class="form-control me-2" id="message">
                        <button class="btn btn-primary" type="button" id="send">
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </div>
                </div>

                <!-- Contenedor para botones "Terminaste?" y "Listo" -->
                <div class="text-center mt-3 d-flex flex-column align-items-center">
                    <div class="contenedor-botones">
                        <div class="terminaste"></div>
                        <div class="listo" id="validateButton" div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../js/dragdrop.js"></script>
    <script src="../js/socket.js"></script>
    <script src="../js/generarDioses.js"></script>
    <script src="../js/devolverDrag.js"></script> <!-- Nuevo script añadido -->
    <script src="../js/validacionDioses.js"></script>
</body>

</html>