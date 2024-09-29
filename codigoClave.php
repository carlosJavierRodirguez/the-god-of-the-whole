<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('principal/head.php') ?>
    <script src="js/cuentaAtras.js"></script>
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

                <form action="" method="post" class="pergamino p-4 p-md-5">
                    <div class="form-group mb-2 email">
                        <div class=" d-flex align-items-center">
                            <div class=" text-white ">
                                <h5>Expira en </h5>
                            </div>
                            <div id="contador" class=" ">
                                <h5 class="text-white"> 10:00</h5>
                            </div>
                            <script>
                                cuentaRegresiva();
                            </script>
                        </div>

                        <input
                            type="number"
                            class="form-control campo-email"
                            id=""
                            name=""

                            required />
                    </div>
                    <!-- Botón de inicio de sesión -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm botonIngresar">
                            <img
                                src="img/botonEnviar.png"
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