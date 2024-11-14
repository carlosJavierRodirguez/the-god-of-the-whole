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
      <div class="col-12 col-md-4 subir">

        <form action="libreria/Accesoinvitado.php" method="post" class="pergamino p-4 p-md-5 needs-validation" novalidate>
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
              <div class="invalid-feedback text-black">
          Nombre con al menos 3 caracteres
          </div>
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
              <div class="invalid-feedback text-black">
          El codigo debe tener minimo 5 numeros
          </div>
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
  <div class="lds-ring loader" id="loader"><h2 class="loading-text">Cargando...</h2><img src="gif/jorgu.gif" alt="" class="loading-gif"><div>
  <iframe id="musicaIframe" src="musica/musica.html" style="display:none;"></iframe>
  <script src="js/validacionFormulario/validacionUnirse.js"></script>
  <script src="js/carga.js"></script>


</body>

</html>