<!DOCTYPE html>
<html lang="es">

<head>
  <?php include('../principal/head.php') ?>
  <link rel="stylesheet" href="../css/ocultar.css">
</head>


<body>
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-4"></div>
      <div class="col-12 col-md-4">
        <div class="d-flex justify-content-center">
          <img src="../img/logo.png" class="logo fa-bounce" alt="" />
        </div>

      </div>

      <div class="col-12 col-md-4"></div>
      <!--botones-->
      <div class="col-12 col-md-4"></div>
      <div class="col-12 col-md-4 subir">

        <form id="formIngresoSala" class="pergamino p-4 p-md-5 needs-validation" novalidate >
          <br>
          <div class="form-group mb-2 email" >
            <!-- Nombre del Jugador -->
            <input  
              data-i18n="nombre"
              data-i18n-placeholder="nombre"
              type="text"
              class="form-control campo-email"
              id="txtNombreJugador"
              name="txtNombreJugador" 
              placeholder = "Nombre del Jugador"
              required />
            <div class="invalid-feedback text-black">
              Nombre con al menos 3 caracteres
            </div>
          </div>
          <div class="form-group mb-2">
            <!-- Pin de Juego -->
            <input
            data-i18n="pin"
              data-i18n-placeholder="pin"
              type="number"
              class="form-control campo-email"
              id="txtCodigoSala"
              name="txtCodigoSala"
              placeholder="Pin de Juego"
              required />
            <div class="invalid-feedback text-black">
              El código debe tener mínimo 5 números
            </div>
          </div>
          <br>
          <!-- Botón de conexión -->
          <div class="text-center">
            <button type="button" id="btnIngresarSala" class="btn btn-mythological" data-i18n="ingresar">Ingresar</button>
            <div>
              <br>
              <h5 class="tipoLetra text-white" data-i18n="propia">Crea tu propia sala</h5>
              <a href="../login/iniciarSesion.php" class="link tipoLetra" data-i18n="iniciarSe">Iniciar sesión</a>
            </div>
          </div>
        </form>

      </div>
      <div class="col-12 col-md-4"></div>
    </div>
  </div>

  <!-- pantalla de carga -->
  <div class="lds-ring loader" id="loader">
    <h2 class="loading-text" data-i18n="cargando">Cargando...</h2><img src="../gif/jorgu.gif" alt="" class="loading-gif">
    <div>
      <iframe id="musicaIframe" src="../musica/musica.html" style="display:none;"></iframe>
    </div>
  </div>

  <script src="../js/carga.js"></script>
  <script src="../js/socket/formularioUnirseSala.js"></script>
  <script src="../js/idioma.js"></script>
</body>

</html>