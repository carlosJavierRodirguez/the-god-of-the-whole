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
        <h1 class="d-flex justify-content-center text-white sofadi-one-regular ">Unirse a Partida</h1>
      </div>

      <div class="col-12 col-md-4"></div>
      <!--botones-->
      <div class="col-12 col-md-4"></div>
      <div class="col-12 col-md-4 subir">
        <form action="" method="get" class="pergamino p-4 p-md-5">
          <div class="form-group mb-2 email">
            <!-- Email -->
            <input
              type="text"
              class="form-control campo-email"
              id="nombreJugador"
              placeholder="Nombre del Jugador"
              required />
          </div>

          <div class="form-group mb-2">
            <!-- Contraseña -->

            <input
              type="number"
              class="form-control campo-email"
              id="password"
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
              <a href="iniciarSesion.php" class="link tipoLetra">Iniciar sesión</a>
            </div>
          </div>
        </form>
      </div>
      <div class="col-12 col-md-4"></div>
    </div>
  </div>
</body>

</html>