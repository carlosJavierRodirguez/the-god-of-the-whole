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

      <div class="col-12 col-md-4"></div>
      <div class="col-12 col-md-4 subir">
        <form action="" method="get">
          <div class="pergamino">
            <div class="col-12 col-md-12 row">
              <div class="col-12 ">
                <h3 class="configuraciones tipoLetra text-white">General</h3>
                <input
                  type="range" min="0" max="10"
                  class="form-range rango "
                  id="rangoGeneral"
                  placeholder="rangoGeneral" />
              </div>
              <div class="col-12">
                <h3 class="rango tipoLetra text-white">Música</h3>
                <input
                  type="range" min="0" max="10"
                  class="form-range rango"
                  id="rangoMusica"
                  placeholder="rangoGeneral" />
              </div>
              <div class="col-12">
                <h3 class="rango tipoLetra text-white">Voces</h3>
                <input
                  type="range" min="0" max="10"
                  class="form-range rango"
                  id="rangoVoces"
                  placeholder="rangoGeneral" />
              </div>
            </div>

            <div class="col-12 btn botonIngresar">
              <a href="index.php" class=" " id="botonGuardar"><img
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

<iframe id="musicaIframe" src="musica.html" style="display:none;"></iframe>
<script src="js/controlVolumen.js"></script>


 

</body>

</html>