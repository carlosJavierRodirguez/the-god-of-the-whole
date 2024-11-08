<!DOCTYPE html>
<html lang="es">

<head>
  <?php include('principal/head.php') ?>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/estilos.css" />
  <link rel="stylesheet" href="css/estilosCarga.css">
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
          <a href="unirse.php" class="buton"><img src="img/botonUnirse.png" alt="imagen de boton para unirse" /></a>
        </div>
        <br />
        <div class="d-flex justify-content-center">
          <a href="login/iniciarSesion.php" class="buton"><img
              src="img/botonCrearSala.png"
              alt="imagen de boton para crear la sala" /></a>
        </div>
      </div>
      <div class="col-12 col-md-4"></div>
    </div>
  </div>
  <div class="lds-ring loader" id="loader"><h2 class="loading-text">Loading...</h2><img src="gif/jorgu.gif" alt="" class="loading-gif"><div>
  <iframe id="musicaIframe" src="musica/musica.html" style="display:none;"></iframe>
  <script src="js/carga.js"></script>
  



</body>

</html>