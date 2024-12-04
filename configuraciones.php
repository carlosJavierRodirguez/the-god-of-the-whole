<!DOCTYPE html>
<html lang="es">

<head>
  <?php include('principal/head.php') ?>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/estilos.css" />
  <link rel="stylesheet" href="css/estilosCarga.css">
  <link rel="stylesheet" href="fontawesome/css/all.css" />
  <link rel="stylesheet" href="css/ocultar.css">
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

      <div class="col-12 col-md-4"></div>
      <div class="col-12 col-md-4 subir">
        <form action="" method="get">
          <div class="pergamino">
            <div class="col-12 col-md-12 row mt-5 pt-5 ">
              
              <div class="col-1"></div>
              <div class="col-10">
                <h3 class="tipoLetra" id="musicLabel" style="margin-top: -10px;" data-i18n="musica">Música</h3>
                <input type="range" min="0" max="10" class="form-range" id="rangoMusica" placeholder="rangoMusica" />
              </div>
              <div class="col-1"></div>
              <br>


            <div class="col-12 btn botonIngresar">
  <a href="index.php" class="btn btn-mythological" id="botonGuardar" data-i18n="guardar">Guardar</a>
</div>
              
            </div>
          </div>
        </form>
      </div>
      <div class="col-12 col-md-4"></div>
    </div>
  </div>
  <div class="lds-ring loader" id="loader"><h2 class="loading-text" data-i18n="cargando">Cargando...</h2><img src="gif/jorgu.gif" alt="" class="loading-gif"><div>
  <iframe id="musicaIframe" src="musica/musica.html" style="display:none;"></iframe>
    <script src="js/idioma.js"></script>
  <script src="js/controlVolumen.js"></script>
  <script src="js/carga.js"></script>






</body>

</html>