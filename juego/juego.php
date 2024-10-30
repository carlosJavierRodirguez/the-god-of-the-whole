<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('../principal/head.php'); ?>
    <link rel="stylesheet" href="../css/estilosJuego.css" />
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
                <div class="woodquest text-center">
                    <h1 class="rondatexto">Ronda: 1</h1>
                    <h2 class="preguntatexto">¿qué considera a los dioses olímpicos?</h2>
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
                        <div class="basi">1</div>
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
                        <div class="listo"></div>
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
</body>

</html>