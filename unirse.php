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
      <div class="col-12 col-md-4 subir">

        <form action="salaEsperaInvitado.php" method="post" class="pergamino p-4 p-md-5">
          <br>
          <div class="form-group mb-2 email">
            <!-- Email -->
            <input
              type="text"
              class="form-control campo-email"
              id="txtNombreJugador"
              name="txtNombreJugador"
              placeholder="Nombre del Jugador"
              required />
          </div>
          <div class="form-group mb-2">
            <!-- Contraseña -->

            <input
              type="number"
              class="form-control campo-email"
              id="txtCodigoSala"
              name="txtCodigoSala"
              placeholder="Pin de Juego"
              required />
          </div>
          <!-- Botón de inicio de sesión -->
          <div class="text-center">
            <button type="submit" class="btn btn-sm botonIngresar">
              <img
                src="img/botonIngresar.png"
                class="img-fluid"
                alt="Boton de ingresar" />
            </button>
            <div>
              <h5 class="tipoLetra text-white">Crea tu propia sala</h5>
              <a href="login/iniciarSesion.php" class="link tipoLetra">Iniciar sesión</a>
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