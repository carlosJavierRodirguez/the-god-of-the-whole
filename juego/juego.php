<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('../principal/head.php'); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilosJuego.css" />
</head>

<body class="pantano">
    <div class="grid-container">
        <div class="item1">
            <div class="muro"></div>
        </div>
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
        <div class="item3">
            <div class="espadas"></div>
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
</body>

</html>