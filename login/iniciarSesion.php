<!DOCTYPE html>
<html lang="es">

<head>
  <?php include('../principal/head.php'); ?>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <!-- Logo y Título -->
      <div class="col-lg-4 col-md-8 col-sm-10">
        <div class="d-flex justify-content-center">
          <img src="../img/logo.png" class="logo fa-bounce" alt="" />
        </div>
        <!-- Formulario de inicio de sesión -->
        <form action="../libreria/acceso.php" method="post" class="pergamino p-4 p-md-5 needs-validation" novalidate>
          <div class="form-group mb-2 email">
            <!-- Email -->
            <span class="text-white fw-bold tipoLetra">Email <i class="fa-solid fa-envelope"></i></span>
            <input
              type="email"
              class="form-control campo-email"
              id="txtEmail"
              name="txtEmail"
              placeholder="correo@gmail.com"
              required
              autocomplete="off" />
            <div class="invalid-feedback text-black">
              Se espera un @
            </div>
          </div>

          <div class="form-group mb-2">
            <!-- Contraseña -->
            <span class="text-white fw-bold tipoLetra">Contraseña <i class="fa-solid fa-key"></i></span>
            <input
              type="password"
              class="form-control campo-email"
              id="txtClave"
              name="txtClave"
              placeholder="********"
              required
              autocomplete="off" />
              
            <div class="d-flex justify-content-end">
              <button type="button" id="togglePassword" class="btn btn-light btn-sm">
                <i class="fa-solid fa-eye"></i>
              </button>
            </div>

            <div class="invalid-feedback text-black">
              Contraseña mínimo 8 caracteres
            </div>
          </div>


          <!-- Botón de inicio de sesión -->
          <div class="text-center">
            <div>
              <a href="recuperarClave.php" class="link tipoLetra">¿Olvidaste tu contraseña?</a>
            </div>
            <div>
              <a href="crearCuenta.php" class="link tipoLetra">¿No tienes cuenta?</a>
            </div>
            <button type="submit" class="btn btn-sm botonIngresar">
              <img
                src="../img/botonIniciarSesion.png"
                class="img-fluid"
                alt="Iniciar Sesión" />
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <iframe id="musicaIframe" src="../musica.html" style="display:none;"></iframe>
  <script src="../js/validacionFormulario/validacionIni.js"></script>
  <script src="../js/clave/mirarClave.js"></script>
</body>

</html>