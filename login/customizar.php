<?php


include('../libreria/datosUsuario/selectPerfilImagenes.php');

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('../principal/head.php') ?>
    <link rel="stylesheet" href="../css/estilosCusto.css">
</head>

<body>

    <div class="pergaminoCu-ontainer">
        <div class="pergaminoCu">

            <div class="iconos">
                <?php
                if (count($selectImagenes) > 0) {
                    foreach ($selectImagenes as $fila) {
                        $idUrl = $fila['id_url'];
                        $urlImagen = $fila['url_imagen'];
                        $nombreImagen = $fila['nombre_imagen'];

                        echo "
                                <div class='col-6 d-flex justify-content-center mb-3'>
                                    <input type='radio' id='imagen_$idUrl' name='imagen_id' value='$idUrl'>
                                    <label for='imagen_$idUrl' class='text-center'>
                                        <img src='" . htmlspecialchars($urlImagen) . "' alt='$nombreImagen' class='seleccionPerfilImagen' />
                                        <br>
                                        <span>$nombreImagen</span>
                                    </label>
                                </div>";
                    }
                } else {
                    echo "<p>No hay imágenes disponibles.</p>";
                }
                ?>
                <!-- Añadir más iconos aquí -->
            </div>

            <button type="button" class="btn btn-sm botonIngresar" id="botonIngresar">
                <img src="img/botonListo.png" class="img-fluid" alt="Iniciar Sesión" />
            </button>
        </div>
    </div>
    <div class="lds-ring loader" id="loader">
        <h2 class="loading-text">Cargando...</h2><img src="gif/jorgu.gif" alt="" class="loading-gif">
        <div>
            <iframe id="musicaIframe" src="../musica/musica.html" style="display:none;"></iframe>
            <script src="../js/icon.js"></script>
            <script src="../js/carga.js"></script>
</body>

</html>