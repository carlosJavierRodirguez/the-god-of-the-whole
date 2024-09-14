<?php
include('libreria/conexion2.php');

$conectar = new conexion();

$conectar->conectar();

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>The god of the whole</title>
  <link rel="stylesheet" href="css/estilos.css" />
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/estilos.css" />
  <link rel="stylesheet" href="fontawesome/css/all.css" />
  <link rel="icon" href="img/logo.png" type="image/x-icon" />
  <link
    href="https://fonts.googleapis.com/css2?family=Jeju+Hallasan&display=swap"
    rel="stylesheet" />
</head>>

<body class="fondoRegistrarse">
  <div class="container">
    <div class="row justify-content-center">
      <!-- Logo y Título -->
      <div class="col-lg-4 col-md-8 col-sm-10">
        <div class="d-flex justify-content-center">
          <img src="img/logo.png" class="logo fa-bounce" alt="" />
        </div>
        <div class="d-flex justify-content-center">
          <h1 class="tipoLetra text-white letraRegistrarse">Registrarse</h1>
        </div>
        <!-- Formulario de inicio de sesión -->
        <form action="libreria/registrarUsuario.php" method="POST" class="pergamino p-4 p-md-5">
          <div class="form-group mb-2 email">
            <!-- Email -->
            <span class="text-white fw-bold tipoLetra">Nombre <i class="fa-solid fa-user"></i></span>
            <input
              type="text"
              class="form-control campo-email"
              id="txtNombreUsuario"
              name="txtNombreUsuario"
              placeholder="Usuario15000"
              required
              autocomplete="off" />
          </div>

          <div class="form-group mb-2">
            <!-- Contraseña -->
            <span class="text-white fw-bold tipoLetra">Email <i class="fa-solid fa-envelope"></i>
            </span>
            <input
              type="email"
              class="form-control campo-email"
              id="txtEmailRegistro"
              name="txtEmailRegistro"
              placeholder="correo@gmail.com"
              required
              autocomplete="off" />
          </div>
          <div class="form-group mb-2">
            <!-- Contraseña -->
            <span class="text-white fw-bold tipoLetra">Contraseña <i class="fa-solid fa-key"></i></span>
            <input
              type="password"
              class="form-control campo-email"
              id="txtClaveRegistro"
              name="txtClaveRegistro"
              placeholder="*******"
              required
              autocomplete="off" />
          </div>
          <!-- Botón de inicio de sesión -->
          <div class="text-center">
            <div class="text-white">
              ¿Ya tienes cuenta?
              <a href="iniciarSesion.html" class="link tipoLetra">Iniciar Sesión</a>
            </div>
            <button type="submit" class="btn btn-sm botonIngresar">
              <img
                src="img/botonRegistrarse.png"
                class="img-fluid"
                alt="Iniciar Sesión" />
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>