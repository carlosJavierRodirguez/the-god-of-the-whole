<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../principal/head.php') ?>
    <link rel="stylesheet" href="../css/codigo.css">
    <link rel="stylesheet" href="../css/estilosCarga.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4"></div>
            <div class="col-12 col-md-4">
                <div class="d-flex justify-content-center">
                    <img src="../img/logo.png" class="logo fa-bounce" alt="Logo" />
                </div>
            </div>
            <div class="col-12 col-md-4"></div>

            <!-- Formulario -->
            <div class="col-12 col-md-4"></div>
            <div class="col-12 col-md-4 subir">
                <form action="../libreria/validarCodigos/validarCodigoClave.php" method="post" class="pergamino p-4 p-md-5">
                    <!-- Campos de código de recuperación -->
                    <div class="mt-5">
                        <div class="codigo mb-4 d-flex justify-content-center bajarInput">
                            <input type="text" maxlength="1" class="form-control" id="input1" name="codigo[]" oninput="nextInput(1)" required>
                            <input type="text" maxlength="1" class="form-control" id="input2" name="codigo[]" oninput="nextInput(2)" required>
                            <input type="text" maxlength="1" class="form-control" id="input3" name="codigo[]" oninput="nextInput(3)" required>
                            <input type="text" maxlength="1" class="form-control" id="input4" name="codigo[]" oninput="nextInput(4)" required>
                        </div>
                    </div>

                    <input type="hidden" name="codigo_original" value="<?php echo isset($_SESSION['codigo_original']) ? $_SESSION['codigo_original'] : ''; ?>">


                    <div class="d-flex align-items-center">
                        <div class="text-white">
                            <a href="../libreria/reenviarCodigo.php" class="link tipoLetra">Reenviar Código</a>
                        </div>
                    </div>
                    <div class="text-center form-group mb-2">
                        <button type="submit" class="btn btn-sm botonIngresar">
                            <img src="../img/botonEnviar.png" class="img-fluid" alt="Botón de ingresar" />
                        </button>
                    </div>
                </form>

                <!-- Mostrar mensaje de error con SweetAlert2 -->
                <?php
                if (isset($_SESSION['error'])): ?>
                    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: '<?php echo $_SESSION['error']; ?>'
                            }).then(() => {
                                window.location.href = '../login/recuperarClave.php'; // Redirige a la página de recuperación
                            });
                        });
                    </script>
                    <!-- <?php
                            unset($_SESSION['error']);
                            ?> Limpiar mensaje después de mostrarlo -->
                <?php endif; ?>
            </div>
            <div class="col-12 col-md-4"></div>
        </div>
    </div>
    <div class="lds-ring loader" id="loader"><h2 class="loading-text">Loading...</h2><img src="../gif/jorgu.gif" alt="" class="loading-gif"><div>    <iframe id="musicaIframe" src="../musica/musica.html" style="display:none;"></iframe>
    <script src="../js/codigos.js"></script>
    <script src="../js/carga.js"></script>
</body>

</html>