<?php
include('../libreria/conexion.php');
$conectar = new Conexion();

$conectar->conectar();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../principal/head.php') ?>
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

                <form action="../libreria/correoOlvidoClave.php" method="post" class="pergamino p-4 p-md-5">
                    <br>
                    <div class="form-group mb-2 email">
                        <span class="text-white fw-bold tipoLetra">Nueva Contraseña <i class="fa-solid fa-key"></i>

                            <input type="password" name="txtCalveNueva" id="txtCalveNueva" placeholder="Contraseña nueva" class="form-control campo-email">
                            <br>
                            <input type="password" name="txtConfirmarClave" id="txtConfirmarClave" placeholder="Confirmar Contraseña nueva" class="form-control campo-email">
                    </div>
                    <br>
                    <!-- Botón de inicio de sesión -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm botonIngresar">
                            <img
                                src="../img/botonGuardar.png"
                                class="img-fluid"
                                alt="Boton de ingresar" />
                        </button>

                    </div>
                </form>
            </div>
            <div class="col-12 col-md-4"></div>
        </div>
    </div>
</body>

</html>