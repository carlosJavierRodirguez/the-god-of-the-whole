<!DOCTYPE html>
<html lang="es">

<head>
  <?php include('principal/head.php') ?>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/estilos.css" />
  <link rel="stylesheet" href="fontawesome/css/all.css" />
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
          <a href="partida.php" class="boton"><img
              src="img/botonJugarOnline.png"
              alt="imagen de boton de jugar online" /></a>
        </div>
        <br />
        <div class="d-flex justify-content-center">
          <a href="configuraciones.php" class="boton"><img
              src="img/botonConfiguracion.png"
              alt="imagen de boton de configuraciones" /></a>
        </div>
      </div>
      <div class="col-12 col-md-4"></div>
    </div>
  </div>
  <iframe id="musicaIframe" src="musica.html" style="display:none;"></iframe>
  <script src="js/controlVolumen.js"></script>
</body>

</html>