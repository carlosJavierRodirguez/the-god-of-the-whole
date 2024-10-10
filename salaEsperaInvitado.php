<?php
include('libreria/classSala.php');

// Obtener los valores del formulario
$codigoSala = $_POST['txtCodigoSala'];

// objeto
$sala = new Sala();
$sala->setCodigoSala($codigoSala);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('principal/head.php') ?>
    <link rel="stylesheet" href="css/salaEsp.css">
</head>

<body>

<div class="pergaminoCu-Container">
        <div class="pergaminoCu">

            <div class="infoSala col-9 text-white">
                <div>Nombre Sala: Carlos</div>
                <div>Codigo: <?php echo $sala->getCodigoSala(); ?> <button class=" bg-transparent border-0"><i class="fa-solid fa-copy"></i></button></i></div>
                
            </div>
            <div class="text-white">Jugadores: 4/4  <i class="fa-solid fa-user"></i> </div>
            <div class="rueda col-9">

                <div class="user-profile col-12">
                    <img class="user-icon" src="img/afrodita.png" alt="">
                    <span class="username">Carlos Javier Rodriguez</span>
                </div>

                <div class="user-profile col-12">
                    <img class="user-icon" src="img/afrodita.png" alt="">
                    <span class="username">Carlos Javier</span>
                </div>

                <div class="user-profile col-12">
                    <img class="user-icon" src="img/afrodita.png" alt="">
                    <span class="username">Carlos Javier</span>
                </div>

                <div class="user-profile col-12">
                    <img class="user-icon" src="img/afrodita.png" alt="">
                    <span class="username">Carlos Javier</span>
                </div>

                <div class="user-profile col-12">
                    <img class="user-icon" src="img/afrodita.png" alt="">
                    <span class="username">Carlos Javier</span>
                </div>


            </div>

        </div>
    </div>

</body>

</html>