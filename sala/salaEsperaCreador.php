<?php
include('../libreria/classSala.php');
include('../libreria/numerosAleatorios.php');
// Obtener los valores del formulario
$nombreSala = $_POST['txtNombreSala'];
$codigoSala = numerosRecuperacion();

// objeto
$sala = new Sala();
$sala->setNombreSala($nombreSala);
$sala->setCodigoSala($codigoSala);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <?php include('../principal/head.php') ?>
  <link rel="stylesheet" href="../css/salaEsp.css">
  <link rel="stylesheet" href="../css/esperaCrea.css">
</head>

<body>

  <div class="pergaminoCu-ontainer">
    <div class="pergaminoCu">

      <div class="infoSala col-9 text-white">
        <div>Nombre Sala: <?php echo $sala->getNombreSala(); ?></div>
        <div>Codigo: <i class="fa-solid fa-copy"></i> </div>

      </div>
      <div class="text-white">Jugadores: 4/4 <i class="fa-solid fa-user"></i> </div>
      <div class="rueda col-9">

        <div class="user-profile col-12">
          <img class="user-icon" src="../img/afrodita.png" alt="">
          <span class="username">Carlos Javier Rodriguez</span>
        </div>

        <div class="user-profile col-12">
          <img class="user-icon" src="../img/afrodita.png" alt="">
          <span class="username">Carlos Javier</span>
        </div>

        <div class="user-profile col-12">
          <img class="user-icon" src="../img/afrodita.png" alt="">
          <span class="username">Carlos Javier</span>
        </div>

        <div class="user-profile col-12">
          <img class="user-icon" src="../img/afrodita.png" alt="">
          <span class="username">Carlos Javier</span>
        </div>


      </div>

      <div class="contenedor">
        <button type="button" class="btn btn-sm botonIngresar" onclick="iniciarTransicion()">
          <img
            src="../img/botonIniciarJuego.png"
            class="img-fluid"
            style="margin-top: 100px;"
            alt="Iniciar Sesión" />
        </button>

        <!-- Iframe para mostrar el archivo HTML -->
        <iframe id="iframe-cargando" src="../cargando.php"></iframe>
      </div>
      <script src="../js/eliminar.js"></script>
      <script src="../js/transicion.js"></script>
</body>

</html>