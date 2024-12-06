<?php
session_start();

// include('../libreria/datosInvitado/imagenPerfilInvitado.php');

// Verificar si el nombre del invitado está en la sesión
if (!isset($_SESSION['nombreInvitado']) || !isset($_SESSION['datosSala'])) {
    // Si las variables de sesión no están configuradas, redirige al inicio
    header("Location: ../invitado/unirse.php");
    exit();
}

$nombreSala = $_SESSION['datosSala']['nombre_sala'] ?? 'No disponible';
$codigoSala = $_SESSION['datosSala']['codigo_sala'] ?? 'No disponible';

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('../principal/head.php') ?>
    <link rel="stylesheet" href="../css/salaEsp.css">
</head>

<body>

    <div class="pergaminoCu-Container">
        <div class="pergaminoCu">

            <div class="infoSala col-9 text-white">
                <div>Nombre Sala: <?php echo $nombreSala; ?></div>
                <div>
                    Código: <span id="codigo-sala"><?php echo $codigoSala; ?></span>
                    <button class="btn-copy bg-transparent border-0">
                        <i class="fa-solid fa-copy"></i>
                    </button>
                </div>
            </div>

            <div class="text-white">Jugadores: <i class="fa-solid fa-user"></i> </div>

            <div class="rueda col-9" id="lista-usuarios">

            </div>

        </div>

    </div>

    <!-- Modal para escoger la imagen de perfil -->
    <div class="modal fade" id="actulizarImagenPerfilModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content user-profile">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Selecciona tu Imagen de Perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Elige una imagen que te represente en el juego:</p>
                    <form id="formActualizarImagenPerfil" method="POST">
                        <div class="row">
                            <?php
                            // Asumiendo que ya tienes la consulta para obtener las imágenes disponibles.
                            //                     if (count($selectImagenes) > 0) {
                            //                         foreach ($selectImagenes as $fila) {
                            //                             $idUrl = $fila['id_url'];
                            //                             $urlImagen = $fila['url_imagen'];
                            //                             $nombreImagen = $fila['nombre_imagen'];

                            //                             echo "
                            // <div class='col-6 d-flex justify-content-center mb-3'>
                            //     <input type='radio' id='imagen_$idUrl' name='imagen_id' value='$idUrl'>
                            //     <label for='imagen_$idUrl' class='text-center'>
                            //         <img src='" . htmlspecialchars($urlImagen) . "' alt='$nombreImagen' class='seleccionPerfilImagen'/>
                            //         <br>
                            //         <span>$nombreImagen</span>
                            //     </label>
                            // </div>";
                            //     }
                            // } else {
                            //     echo "<p>No hay imágenes disponibles.</p>";
                            // }
                            ?>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="submit" class="btn border-0">
                                <img src="../img/botonGuardar.png" alt="">
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/socket/usuarioOnline.js"></script>
    <script type="module" src="../js/main.js"></script>
</body>

</html>