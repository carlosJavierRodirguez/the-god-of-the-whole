<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>The god of the whole</title>

  <!-- Icono de la página -->
  <link rel="icon" href="img/logo.png" type="image/x-icon" />
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
      <br/><br/>
        <div class="d-flex justify-content-center">
        <a href="partida.php" class="btn btn-mythological">Jugar Online</a>
        </div>
        <br />
        <div class="d-flex justify-content-center">
        <a href="configuraciones.php" class="btn btn-mythological">Configuraciones</a>
        </div>
      </div>
      <div class="col-12 col-md-4"></div>
    </div>
  </div>

  <div class="lds-ring loader" id="loader">
    <h2 class="loading-text">Cargando...</h2><img src="gif/jorgu.gif" alt="" class="loading-gif">
    <div>
      <iframe id="musicaIframe" src="musica/musica.html" style="display:none;"></iframe>
      <script src="js/carga.js"></script>


</body>

</html>