<!DOCTYPE html>
<html lang="es">

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
                        <span class="text-white fw-bold tipoLetra" data-i18n="email">Email</span>  <i class="fa-solid fa-envelope text-white"></i>
                            <!-- Email -->
                            <input
                                data-i18n="email"
                                data-i18n-placeholder="correo"
                                type="email"
                                class="form-control campo-email"
                                id="txtEmailRecuperar"
                                name="txtEmailRecuperar"
                                placeholder="correo@gmail.com"
                                required />
                    </div>
                    <br>

                    <div class="text-center">
                    <button type="submit" class="btn btn-mythological">Enviar
                        </button>

                    </div>
                </form>
            </div>
            <div class="col-12 col-md-4"></div>
        </div>
    </div>
    <div class="lds-ring loader" id="loader"><h2 class="loading-text">Cargando...</h2><img src="../gif/jorgu.gif" alt="" class="loading-gif"><div>
    <iframe id="musicaIframe" src="../musica/musica.html" style="display:none;"></iframe>
    <script src="../js/carga.js"></script>
    <script src="../js/idioma.js"></script>
</body>

</html>