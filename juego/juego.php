<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('../principal/head.php'); ?>
    <link rel="stylesheet" href="../css/estilosJuego.css" />
</head>

<body class="pantano">
    <div class="container">
        <div class="row">

            <!-- Columna para el dropzone -->
            <div class="col-lg-9 col-md-8 col-sm-12">
                <div class="woodquest text-center">
                    <h1 class="rondatexto">Ronda: 1</h1>
                    <h2 class="preguntatexto">¿que considera a los dioses olympicos?</h2>
                </div>
                <div class="item4" id="dropzone">
                    <div class="pergaminove"></div>
                </div>

                <div class="col-12 pt-3">
                    <div class="tablajuego container" id="drag-container">
                        <div class="row">
                            <div class="col-3 draggable" draggable="true" id="item1"></div>
                            <div class="col-3 draggable" draggable="true" id="item2"></div>
                            <div class="col-3 draggable" draggable="true" id="item3"></div>
                            <div class="col-3 draggable" draggable="true" id="item4"></div>
                            <div class="col-3 draggable" draggable="true" id="item5"></div>
                        </div>
                        <div class="row">
                            <div class="col-3 draggable" draggable="true" id="item6"></div>
                            <div class="col-3 draggable" draggable="true" id="item7"></div>
                            <div class="col-3 draggable" draggable="true" id="item8"></div>
                            <div class="col-3 draggable" draggable="true" id="item9"></div>
                            <div class="col-3 draggable" draggable="true" id="item10"></div>
                        </div>
                        <div class="row">
                            <div class="col-3 draggable" draggable="true" id="item11"></div>
                            <div class="col-3 draggable" draggable="true" id="item12"></div>
                            <div class="col-3 draggable" draggable="true" id="item13"></div>
                            <div class="col-3 draggable" draggable="true" id="item14"></div>
                            <div class="col-3 draggable" draggable="true" id="item15"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Columna de chat (con imagen ocupando su espacio) -->
            <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="chat container border rounded p-2 justify-content-start">
                    <!-- Nueva imagen dentro del contenedor de chat -->
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
            </div>

        </div>

        <div class="row mt-3">
            <!-- Aquí podrías agregar más columnas si es necesario -->
        </div>

    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../js/dragdrop.js"></script>
    <script src="../js/socket.js"></script>
</body>

</html>