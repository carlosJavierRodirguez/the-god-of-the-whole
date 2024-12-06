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
            <div class="woodquest mt-2 mostrar-preguntas">
    <h1 id="pregunta" class="pregunta-texto text-center">Cargando pregunta...</h1>
    <p id="contador" class="text-center">Tiempo restante: 20s</p>
</div>
            </div>
            <div class="col-1"></div>
            <div class="col-3">
                <div class="contenedor-botones mt-1">
                    <div class="listo" id="validateButton"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-8">
                <div class="text-center pergaminove" id="dropzone"></div>
            </div>
            <div class="col-1"></div>
            <div class="col-3">
                <!-- Botones de interacción -->
                <div class="text-center mt-2">
                    <button type="button" class="btn btn-primary position-relative">
                        Chat <i class="fa-brands fa-rocketchat"></i>
                        <span id="messageCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            0
                        </span>
                    </button>
                </div>

                <div class="text-center mt-2">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#gifModal">
                        Tutorial <i class="fa-solid fa-circle-info"></i>
                    </button>
                </div>

                <div class="text-center mt-2">
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#audioConfigModal">
                        Música <i class="fa-solid fa-music"></i>
                    </button>
                </div>

                <div class="text-center mt-3">
                    <div class="zeus-gif"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-8 tablajuego rounded" id="drag-container">
                <!-- Aquí se generarán los elementos de los dioses aleatoriamente -->
            </div>
            <div class="col-1"></div>
            <div class="col-3 border">
                <h1 class="text-white text-center">Usuarios en línea o ranking</h1>
            </div>
        </div>
    </div>

    <!-- Modales -->
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

    <!-- Modal para explicarle al usuario cómo jugar -->
    <div class="modal fade custom-gif-modal" id="gifModal" tabindex="-1" aria-labelledby="gifModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="row">
                        <div class="col-12">
                            <p class="pregunta-texto text-center">
                                Observa cómo se seleccionan las opciones correctas y arrástralas al área correspondiente. <br>
                                Asegúrate de completarlas antes de que el tiempo se acabe. ¡Suerte! <i class="fa-regular fa-face-smile-wink"></i>
                            </p>
                        </div>
                        <div class="col-12"> <img src="../gif/pregunta.gif" alt="GIF" class="img-fluid rounded"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para configurar el audio -->
    <div class="modal fade custom-audio-modal" id="audioConfigModal" tabindex="-1" aria-labelledby="audioConfigModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="audio-config-container">
                        <h3 class="tipoLetra mb-4">Configuración de Audio</h3>
                        <div class="audio-slider-container">
                            <label for="rangoMusica" class="form-label">Volumen de Música</label>
                            <input type="range" min="0" max="10" class="form-range" id="rangoMusica" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="guardarConfigAudio">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para el chat -->
    <div id="chatModal" class="chat-modal" style="display: none;">
        <div class="chat-modal-content border">
            <div class="chat-modal-header basi" id="chatModalHeader">
                <i class="fa-solid fa-xmark chat-close-btn"></i>
            </div>
            <div class="chat mt-2  rounded p-2">

                <div class="messages mb-3" id="messages"></div>
                <div class="send-message d-flex">
                    <input type="text" class="form-control me-2" id="message">
                    <button class="btn btn-primary" type="button" id="send">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <iframe id="musicaIframe" src="../musica/musicaJuego.html" allow="autoplay" style="display:none;"></iframe>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="../js/main.js"></script>
    <script src="../js/audio.js"></script>
    <script src="../js/juego-js/dragDrop/generarDioses.js"></script>
    <script src="../js/juego-js/dragDrop/arrastrarYsoltar.js"></script>
    <script src="../js/juego-js/dragDrop/crearDropZone.js"></script>
    <script src="../js/juego-js/dragDrop/devolverDrag.js"></script>
    <script src="../js/juego-js/validacion/validacionDioses.js"></script>

</body>

</html>