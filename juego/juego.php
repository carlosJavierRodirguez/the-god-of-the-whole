<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('../principal/head.php'); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilosJuego.css" />
</head>

<body class="pantano">
    <div class="grid-container pt-3">
        <div class="item2">
            <div class="arboles">
                <div id="drag-container">

                    <div class="draggable" draggable="true" id="item1"></div>

                    <div class="draggable" draggable="true" id="item2"></div>

                    <div class="draggable" draggable="true" id="item3"></div>

                    <div class="draggable" draggable="true" id="item4"></div>

                    <div class="draggable" draggable="true" id="item5"></div>

                    <div class="draggable" draggable="true" id="item6"></div>

                </div>
            </div>
        </div>

        <div class="chat container border rounded p-2 ">
            <div class="messages p-3 mb-3" id="messages"></div>
            <div class="send-message d-flex">
                <input type="text" class="form-control me-2" id="message">
                <button class="btn btn-primary" type="button" id="send"><i class="fa-solid fa-paper-plane"></i></button>
            </div>
        </div>


        <div class="item4" id="dropzone">
            <div class="pergaminove"></div>
        </div>
        <div class="item5">
            <div class="titulo2"></div>
        </div>
    </div>


    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../js/dragdrop.js"></script>
    <script src="../js/socket.js"></script>
</body>

</html>