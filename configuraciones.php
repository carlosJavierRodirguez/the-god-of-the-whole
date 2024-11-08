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

      <div class="col-12 col-md-4"></div>
      <div class="col-12 col-md-4 subir">
        <form action="" method="get">
          <div class="pergamino">
            <div class="col-12 col-md-12 row mt-5 pt-5 ">
              <div class="col-1"></div>
              <div class="col-10">
                <h3 class="letra tipoLetra" style="margin-top: -10px;">General</h3> <!-- Ajusta el margen superior -->
                <input type="range" min="0" max="10" class="form-range" id="rangoGeneral" placeholder="rangoGeneral" />
              </div>
              <div class="col-1"></div>

              <div class="col-1"></div>
              <div class="col-10">
                <h3 class="tipoLetra" style="margin-top: -10px;">Música</h3> <!-- Ajusta el margen superior -->
                <input type="range" min="0" max="10" class="form-range" id="rangoMusica" placeholder="rangoMusica" />
              </div>
              <div class="col-1"></div>

              <div class="col-1"></div>
              <div class="col-10">
                <h3 class="tipoLetra" style="margin-top: -10px;">Voces</h3> <!-- Ajusta el margen superior -->
                <input type="range" min="0" max="10" class="form-range" id="rangoVoces" placeholder="rangoVoces" />
              </div>
              <div class="col-1"></div>
            </div>

            <div class="col-12 btn botonIngresar">
              <a href="index.php" class="" id="botonGuardar"><img
                  src="img/botonGuardar.png"
                  alt="imagen de boton de guardar"
                  class="img-fluid" /></a>
            </div>
          </div>
        </form>
      </div>
      <div class="col-12 col-md-4"></div>
    </div>
  </div>
  <div class="lds-ring loader" id="loader"><h2 class="loading-text">Loading...</h2><img src="gif/jorgu.gif" alt="" class="loading-gif"><div>
  <iframe id="musicaIframe" src="musica/musica.html" style="display:none;"></iframe>
  <script src="js/controlVolumen.js"></script>
  <script src="js/carga.js"></script>





</body>

</html>