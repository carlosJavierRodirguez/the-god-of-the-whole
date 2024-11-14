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
                            echo  $pregunta['pregunta'];

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
        <div class="terminaste" data-bs-toggle="modal" data-bs-target="#terminaste"></div>
        <div class="listo" id="validateButton"></div>
    </div>
</div>

<div>
    <div class="modal fade" id="terminaste" tabindex="-1" aria-labelledby="terminasteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg border-0">
            <div class="modal-content" style="background-color: rgba(0, 0, 0, 0.2); border: 2px solid gold; box-shadow: 0 0 15px 5px rgba(255, 223, 0, 0.7); border-radius: 15px;">
                <div class="modal-header border-0">
                    <h2 style="color: white;">Ranking</h2>
                    <button class="btn btn-primary" id="validateButton" type="button">
                        <span>Cerrar</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Línea divisoria -->
                    <div class="col2"></div>
                    <div class="col-8 border"></div>
                    <div class="col-2"></div>

                    <!-- Ranking de jugadores con fondo -->
                    <div class="ranking-container mt-4 p-4">
                        <div class="row justify-content-center">
                             <!-- Primer Usuario -->
    <div class="col-3 text-center">
        <img src="../img/afrodita (4).png" alt="Usuario 1" class="img-fluid rounded-circle mb-2"
            style="width: 70px; height: 70px;">
        <p class="text-white" style="margin-bottom: 5px;">Carlitos</p>
        <p class="text-white" style="margin-bottom: 5px;">Puesto: 1</p>
        <p class="text-white" style="margin-bottom: 0;">Puntuación: 2000</p>
    </div>

    <!-- Segundo Usuario -->
    <div class="col-3 text-center">
        <img src="../img/afrodita (4).png" alt="Usuario 2" class="img-fluid rounded-circle mb-2"
            style="width: 70px; height: 70px;">
        <p class="text-white" style="margin-bottom: 5px;">Cristian</p>
        <p class="text-white" style="margin-bottom: 5px;">Puesto: 2</p>
        <p class="text-white" style="margin-bottom: 0;">Puntuación: 1450</p>
    </div>

    <!-- Tercer Usuario -->
    <div class="col-3 text-center">
        <img src="../img/afrodita (4).png" alt="Usuario 3" class="img-fluid rounded-circle mb-2"
            style="width: 70px; height: 70px;">
        <p class="text-white" style="margin-bottom: 5px;">Manolito</p>
        <p class="text-white" style="margin-bottom: 5px;">Puesto: 3</p>
        <p class="text-white" style="margin-bottom: 0;">Puntuación: 1200</p>
    </div>
</div>

<!-- Segunda fila para los usuarios adicionales -->
<div class="row justify-content-center mt-4">
     <!-- Cuarto Usuario -->
     <div class="col-3 text-center">
        <img src="../img/afrodita (4).png" alt="Usuario 4" class="img-fluid rounded-circle mb-2"
            style="width: 70px; height: 70px;">
        <p class="text-white" style="margin-bottom: 5px;">Juanito</p>
        <p class="text-white" style="margin-bottom: 5px;">Puesto: 4</p>
        <p class="text-white" style="margin-bottom: 0;">Puntuación: 1050</p>
    </div>

    <!-- Quinto Usuario -->
    <div class="col-3 text-center">
        <img src="../img/afrodita (4).png" alt="Usuario 5" class="img-fluid rounded-circle mb-2"
            style="width: 70px; height: 70px;">
        <p class="text-white" style="margin-bottom: 5px;">Carla</p>
        <p class="text-white" style="margin-bottom: 5px;">Puesto: 5</p>
        <p class="text-white" style="margin-bottom: 0;">Puntuación: 700</p>
    </div>
</div>
            </div><!-- .ranking-container.mt-4.p-4 -->
        </div><!-- .modal-body -->
    </div><!-- .modal-content -->
</div><!-- .modal-dialog -->
</div><!-- .modal.fade -->
</div>








    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../js/dragdrop.js"></script>
    <script src="../js/socket.js"></script>
    <script src="../js/generarDioses.js"></script>
    <script src="../js/devolverDrag.js"></script> <!-- Nuevo script añadido -->
    <script src="../js/validacionDioses.js"></script>
</body>

</html>