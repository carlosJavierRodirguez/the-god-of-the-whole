<!DOCTYPE html>
<html lang="es">

<head>
  <?php include('principal/head.php') ?>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-4"></div>
      <div class="col-12 col-md-4">
        <div class="d-flex justify-content-center">
          <img src="img/logo.png" class="logo fa-bounce" alt="" />
        </div>
      </div>

      <div class="col-12 col-md-4"></div>
      <!--botones-->
      <div class="col-12 col-md-4"></div>
      <div class="col-12 col-md-4">
        <div class="d-flex justify-content-center">
          <a href="unirse.php" class="boton"><img src="img/botonUnirse.png" alt="imagen de boton para unirse" /></a>
        </div>
        <br />
        <div class="d-flex justify-content-center">
          <a href="iniciarSesion.php" class="boton"><img
              src="img/botonCrearSala.png"
              alt="imagen de boton para crear la sala" /></a>
        </div>
      </div>
      <div class="col-12 col-md-4"></div>
    </div>
  </div>

<iframe id="musicaIframe" src="musica.html" style="display:none;"></iframe>
<script src="js/controlVolumen.js"></script>



</body>

</html>