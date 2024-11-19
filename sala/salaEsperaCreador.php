<?php
session_start();

require_once('../libreria/juego/datosSala.php');
// Verificar si la sesión 'nombreUsuario' está configurada
if (!isset($_SESSION['nombreUsuario'])) {
  header('Location: ../login/iniciarSesion.php'); // Redirigir a la página de inicio de sesión
  exit();
} else {
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <?php include('../principal/head.php') ?>
  <link rel="stylesheet" href="../css/salaEsp.css">
  <link rel="stylesheet" href="../css/esperaCrea.css">
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <!-- Logo y Título -->
      <div class="col-lg-4 col-md-8 col-sm-10">
        <div class="pergamino p-4 p-md-5">
          <div class="form-group mb-2 text-white email infoSala">
            <div>Nombre Sala: <?php echo $sala->getNombreSala(); ?></div>
            <div>Codigo: <?php echo $sala->getCodigoSala(); ?> <button type="button" class="btn border-0"><i class="fa-solid fa-copy"></i></button> </div>

          </div>
          <div class="user-profile form-group mt-2 rounded ">
            <img class="user-icon" src="../img/diosesVerdaderos/afrodita.png" alt="">
            <span class="username">Carlos Javier Rodriguez</span>
          </div>
        </div>
        <button type="button" class="btn btn-sm botonIngresar" onclick="iniciarTransicion()">
          <img
            src="../img/botonIniciarJuego.png"
            class="img-fluid"
            style="margin-top: 100px;"
            alt="Iniciar Sesión" />
        </button>

      </div>
    </div>
    <!-- <div class="-ontainer"> -->
    <!-- <div class="pergaminoCu">

      <div class="infoSala col-9 text-white">
        <div>Nombre Sala: <?php echo $sala->getNombreSala(); ?></div>
        <div>Codigo: <?php echo $sala->getCodigoSala(); ?> <button type="button" class="btn border-0"><i class="fa-solid fa-copy"></i></button> </div>

      </div>
      <div class="text-white">Jugadores: 4/4 <i class="fa-solid fa-user"></i> </div>
      <div class="rueda col-9">

        <div class="user-profile col-12">
          <img class="user-icon" src="../img/afrodita.png" alt="">
          <span class="username">Carlos Javier Rodriguez</span>
        </div>


      </div>


    </div>

    <div class="contenedor">
      <button type="button" class="btn btn-sm botonIngresar" onclick="iniciarTransicion()">
        <img
          src="../img/botonIniciarJuego.png"
          class="img-fluid"
          style="margin-top: 100px;"
          alt="Iniciar Sesión" />
      </button> -->

    <!-- Iframe para mostrar el archivo HTML --> -
    <iframe id="iframe-cargando" src="../cargando.php"></iframe>
  </div>
  </div>
  <script src="../js/eliminar.js"></script>
  <script src="../js/transicion.js"></script>
</body>

</html>