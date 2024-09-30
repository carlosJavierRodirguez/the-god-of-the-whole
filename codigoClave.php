<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('principal/head.php') ?>
    <script src="js/cuentaAtras.js"></script>
    <link rel="stylesheet" href="css/codigo.css">
    <style>

    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4"></div>
            <div class="col-12 col-md-4">
                <div class="d-flex justify-content-center">
                    <img src="img/logo.png" class="logo fa-bounce" alt="Logo" />
                </div>
            </div>
            <div class="col-12 col-md-4"></div>

            <!-- Formulario -->
            <div class="col-12 col-md-4"></div>
            <div class="col-12 col-md-4 subir">
                <form action="" method="post" class="pergamino p-4 p-md-5">
                    <br>
                    <div class="form-group mb-2 email">
                        <div class="d-flex align-items-center">
                            <div class="text-white">
                                <h5>Expira en </h5>
                            </div>
                            <div id="contador">
                                <h5 class="text-white">10:00</h5>
                            </div>
                        </div>
                        <script>
                            cuentaRegresiva();
                        </script>
                    </div>
                    <br>
                    <!-- Campos de código de recuperación -->
                    <div class="codigo mb-4 d-flex justify-content-center">
                        <input type="text" maxlength="1" class="form-control" id="input1" oninput="nextInput(1)" required>
                        <input type="text" maxlength="1" class="form-control" id="input2" oninput="nextInput(2)" required>
                        <input type="text" maxlength="1" class="form-control" id="input3" oninput="nextInput(3)" required>
                        <input type="text" maxlength="1" class="form-control" id="input4" oninput="nextInput(4)" required>
                    </div>

                    <!-- Botón de inicio de sesión -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm botonIngresar">
                            <img src="img/botonEnviar.png" class="img-fluid" alt="Botón de ingresar" />
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-4"></div>
        </div>
    </div>

    <script src="js/codigos.js"></script>
</body>



</html>