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
                    // Verificar el resultado de la consulta  //Verificar si criss es gay.
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
                    <p id="contador" class="text-center">Tiempo restante: 20s</p>
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
            <div class="col-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="fa-brands fa-rocketchat"></i>
                </button>
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
    <!-- modales -->

    
 

<div id="winModal" class="modal custom-win-modal" style="display: none;">
    <div class="modal-wrapper">
        <div class="gif-container">
            <img src="../gif/demonn.gif" alt="Win Celebration" class="modal-gif">
        </div>
        <div class="modal-content">
            <h2>¡Felicidades!</h2>
            <p>Puntos ganados: <span id="puntos"></span></p>
        </div>
    </div>
</div>

<!-- Modal de Perder -->
<div id="loseModal" class="modal custom-lose-modal" style="display: none;">
    <div class="modal-wrapper">
        <div class="gif-container">
            <img src="../gif/demonn.gif" alt="Lose Animation" class="modal-gif">
        </div>
        <div class="modal-content">
            <h2>¡Perdiste!</h2>
            <p>No alcanzaste a presionar el botón a tiempo.</p>
            <p>Puntos ganados: 0</p>
        </div>
    </div>
</div>





    <!-- Modal para el chat -->

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class=" chat mt-2 border rounded p-2">
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
            </div>
        </div>


        <iframe id="musicaIframe" src="../musica/musicaJuego.html" allow="autoplay" style="display:none;"></iframe>
        <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../js/socket/socket.js"></script>
        <script src="../js/juego-js/dragDrop/generarDioses.js"></script>
        <script src="../js/juego-js/dragDrop/devolverDrag.js"></script>
        <script src="../js/juego-js/validacion/validacionDioses.js"></script>
        <script src="../js/tempori.js"></script>
</body>

</html>