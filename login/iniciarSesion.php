<!DOCTYPE html>
<html lang="es">

<head>
  <?php include('../principal/head.php'); ?>
  <link rel="stylesheet" href="../css/ocultar.css">
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
            <span class="text-white fw-bold tipoLetra" data-i18n="email">   Email   </span> <i class="fa-solid fa-envelope text-white"></i>
            <input
              data-i18n="correo"
              data-i18n-placeholder="correo"
              type="email"
              class="form-control campo-email"
              id="txtEmail"
              maxlength="100"
              name="txtEmail"
              placeholder="correo@gmail.com"
              required
              autocomplete="off" />
            <div class="invalid-feedback text-black" data-i18n="min">
              Se espera un @
            </div>
          </div>

          <div class="form-group mb-2">
            <!-- Contraseña -->
            <span class="text-white fw-bold tipoLetra"  data-i18n="contra">Contraseña </span> <i class="fa-solid fa-key text-white"></i>
            <input
              type="password"
              class="form-control campo-email"
              id="txtClave"
              maxlength="30"
              name="txtClave"
              placeholder="********"
              required
              autocomplete="off" />

            <div class="d-flex justify-content-end">
              <button type="button" id="togglePassword" class="btn btn-light btn-sm">
                <i class="fa-solid fa-eye"></i>
              </button>
            </div>

            <div class="invalid-feedback text-black" data-i18n="minp">
              Contraseña mínimo 8 caracteres
            </div>
          </div>


          <!-- Botón de inicio de sesión -->
          <div class="text-center">
            <div>
              <a href="recuperarClave.php" class="link tipoLetra" data-i18n="olvidar" >¿Olvidaste tu contraseña?</a>
            </div>
            <div>
              <a href="crearCuenta.php" class="link tipoLetra" data-i18n="cuenta">¿No tienes cuenta?</a>
            </div>
            <button type="submit" class="btn btn-mythological" data-i18n="iniciarSe">Iniciar Sesión
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <iframe id="musicaIframe" src="../musica/musica.html" style="display:none;"></iframe>
  <script src="../js/validacionFormulario/validacionIni.js"></script>
  <script src="../js/clave/mirarClave.js"></script>
  <script src="../js/idioma.js"></script>
</body>

</html>