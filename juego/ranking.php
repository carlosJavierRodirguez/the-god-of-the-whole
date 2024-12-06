<?php

include('../libreria/juego/listarPreguntas.php');

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('../principal/head.php'); ?>
    <link rel="stylesheet" href="../css/estilosRanking.css" />
</head>
</head>
<body>
    <div class="container-fluid ranking-container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="ranking-podium">
                    <!-- Tercer Puesto -->
                    <div id="third-place" class="ranking-position col-md-4">
                        <img src="../img/afrodita (4).png" alt="Tercer Lugar" class="avatar">
                        <div class="name">Hermes</div>
                        <div class="puntos">200 Puntos</div>
                        <img src="../img/pilarDorado.png" alt="Pilar" class="pillar">
                    </div>
                    
                    <!-- Primer Puesto -->
                    <div id="first-place" class="ranking-position col-md-4">
                        <img src="../img/afrodita (4).png" alt="Primer Lugar" class="avatar">
                        <div class="name">Zeus</div>
                        <div class="puntos">300 Puntos</div>
                        <img src="../img/pilarDorado.png" alt="Pilar" class="pillar">
                    </div>
                    
                    <!-- Segundo Puesto -->
                    <div id="second-place" class="ranking-position col-md-4">
                        <img src="../img/afrodita (4).png" alt="Segundo Lugar" class="avatar">
                        <div class="name">Poseidón</div>
                        <div class="puntos">250 Puntos</div>
                        <img src="../img/pilarDorado.png" alt="Pilar" class="pillar">
                    </div>
                </div>

                <div class="user-ranking">
                    <h2 class="mb-3">Tu Ranking</h2>
                    <img src="../img/afrodita (4).png" alt="Avatar Usuario" class="user-avatar">
                    <p class="mb-2">Posición: 15</p>
                    <p>Puntos: 240</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>