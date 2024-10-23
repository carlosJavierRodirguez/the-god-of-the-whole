<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('../principal/head.php'); ?>
    <link rel="stylesheet" href="../css/estilosJuego.css" />
</head>

<body class="pantano">
    <div class="container">
        <div class="row">

            <!-- Columna de chat -->
            <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="chat container border rounded p-2 justify-content-start">
                    <div class="messages p-3 mb-3" id="messages"></div>
                    <div class="send-message d-flex">
                        <input type="text" class="form-control me-2" id="message">
                        <button class="btn btn-primary" type="button" id="send">
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Columna para el dropzone -->
            <div class="col-lg-9 col-md-8 col-sm-12">
                <div class="text-center text-white">
                    <h1>Pregunta?</h1>
                </div>
                <div class="item4" id="dropzone">
                    <div class="pergaminove"></div>
                </div>
            </div>

            <!-- Columna para los elementos arrastrables -->
            <div class="col-12 pt-3">
                <div class="arboles" id="drag-container">
                    <div class="draggable" draggable="true" id="item1"></div>
                    <div class="draggable" draggable="true" id="item2"></div>
                    <div class="draggable" draggable="true" id="item3"></div>
                    <div class="draggable" draggable="true" id="item4"></div>
                    <div class="draggable" draggable="true" id="item5"></div>
                    <div class="draggable" draggable="true" id="item6"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../js/dragdrop.js"></script>
    <script src="../js/socket.js"></script>
</body>


</html>