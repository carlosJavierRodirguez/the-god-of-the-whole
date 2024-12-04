<?php
include('../libreria/conexion.php');

$conectar = new conexion();

$conectar->conectar();

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <?php include('../principal/head.php') ?>
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
        <form action="../libreria/registrarUsuario.php" method="POST" class="pergamino p-4 p-md-5 needs-validation" novalidate>
          <div class="form-group mb-2 email">
            <!-- Email -->
            <span class="text-white fw-bold tipoLetra" data-i18n="name" >Nombre </span> <i class="fa-solid fa-user text-white"></i>
            <input
            data-i18n="user"
            data-i18n-placeholder="user"
              type="text"
              class="form-control campo-email"
              id="txtNombreUsuario"
              maxlength="25"
              name="txtNombreUsuario"
              placeholder="Usuario15000"
              required
              autocomplete="off" />
            <div class="invalid-feedback text-black">
              Mínimo 5 caracteres.
            </div>
          </div>


          <div class="form-group mb-2">
            <!-- Contraseña -->
            <span class="text-white fw-bold tipoLetra" data-i18n="email">Email
            </span>  <i class="fa-solid fa-envelope text-white"></i>
            <input
              data-i18n="correo"
              data-i18n-placeholder="correo"
              type="email"
              class="form-control campo-email"
              id="txtEmailRegistro"
              maxlength="100"
              name="txtEmailRegistro"
              placeholder="correo@gmail.com"
              required
              autocomplete="off" />
            <div class="invalid-feedback text-black">
              Introduce un email válido
            </div>
          </div>

          <div class="form-group mb-2">
            <!-- Contraseña -->
            <span class="text-white fw-bold tipoLetra" data-i18n="contra">Contraseña</span> <i class="fa-solid fa-key text-white"></i>
            <input
              type="password"
              class="form-control campo-email"
              id="txtClaveRegistro"
              maxlength="30"
              name="txtClaveRegistro"
              placeholder="*******"
              required
              autocomplete="off" />
            <div class="d-flex justify-content-end">
              <button type="button" id="togglePassword" class="btn btn-light btn-sm">
                <i class="fa-solid fa-eye"></i>
              </button>
            </div>
            <div class="invalid-feedback text-black" data-i18n="minp">
              Contraseña al menos de 8 caracteres
            </div>
          </div>

          <!-- Botón de inicio de sesión -->
          <div class="text-center">
          <a href="iniciarSesion.php" class="link tipoLetra" data-i18n="tener">¿Ya tienes una cuenta?</a>

              <div>
             
              </div></div>
              <br>
            <button type="submit" class="btn btn-mythological" data-i18n="registrar">
              Registrarse
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="lds-ring loader" id="loader" ><h2 class="loading-text" data-i18n="cargando">Cargando...</h2><img src="../gif/jorgu.gif" alt="" class="loading-gif"><div>
  <iframe id="musicaIframe" src="../musica/musica.html" style="display:none;"></iframe>
  <script src="../js/validacionFormulario/validacion.js"></script>
  <script src="../js/clave/mirarClave.js"></script>
  <script src="../js/carga.js"></script>
  <script src="../js/idioma.js"></script>
 
</body>

</html>