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
  <link rel="stylesheet" href="../css/estilosCarga.css">
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <!-- Logo y Título -->
      <div class="col-lg-4 col-md-8 col-sm-10 ">
        <div class="pergamino md-5 mt-3 ">
          <div class="form-group mb-2 text-white infoSala p-4">
            <div>Nombre Sala: <?php echo $sala->getNombreSala(); ?></div>
            <div>Codigo: <?php echo $sala->getCodigoSala(); ?> <button type="button" class="btn border-0"><i class="fa-solid fa-copy"></i></button> </div>
            <div class="text-white text-center">Jugadores:<i class="fa-solid fa-user"></i> </div>
          </div>

          <div class="p-4 mt-4 rueda">
            <ul id="lista-usuarios"></ul>
            <!-- <div class="user-profile form-group mt-2 rounded ">
              <img class="user-icon" src="../img/diosesVerdaderos/afrodita.png" alt="">
              <span class="username">Carlos Javier Rodriguez</span>
            </div> -->


          </div>
        </div>


        <!-- botón de iniciarl la sala -->
        <div class="d-flex justify-content-center">
          <button type="button" class="btn btn-sm text-center border-0 " onclick="iniciarTransicion()">
            <img
              src="../img/botonIniciarJuego.png"
              class="botonIniciarJuego"
              alt="Iniciar Juego" />
          </button>
        </div>
      </div>
    </div>

  </div>

  <!-- pantalla de carga -->
  <div class="lds-ring loader" id="loader">
    <h2 class="loading-text">Cargando...</h2><img src="../gif/jorgu.gif" alt="" class="loading-gif">
    <div>
      <iframe id="musicaIframe" src="../musica/musica.html" style="display:none;"></iframe>
      <script src="../js/carga.js"></script>
    </div>
  </div>

  <script src="../js/socket/usuarioOnline.js"></script>
  <script src="../js/eliminar.js"></script>
  <script src="../js/transicion.js"></script>
</body>

</html>