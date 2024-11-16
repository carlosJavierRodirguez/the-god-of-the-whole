<?php
session_start();

include('../libreria/datosUsuario/imagenPerfil.php');
include('../libreria/datosUsuario/partidas.php');
include('../libreria/datosUsuario/selectPerfilImagenes.php');

// Verificar si la sesión 'nombreUsuario' está configurada
if (!isset($_SESSION['nombreUsuario'])) {
    header('Location: ../login/iniciarSesion.php'); // Redirigir a la página de inicio de sesión
    exit();
} else {
}

// nombre de usuario
$nombreUsuario = $_SESSION['nombreUsuario'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('../principal/head.php') ?>
    <link rel="stylesheet" href="../css/estilosUSer.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-2 d-none d-md-block">
                <!-- Espacio en el lado izquierdo -->
            </div>
            <div class="col-12 col-md-10">
                <div class="contenedor align-self-start">
                    <br>

                    <button type="button" class="btn contenedor-item border border-0 " data-bs-toggle="modal" data-bs-target="#crearSala">
                        <i class="fa-solid fa-circle-plus"></i>
                        <p>Crear Sala</p>
                    </button>


                    <button type="button" class="btn contenedor-item border border-0" data-bs-toggle="modal" data-bs-target="#unirsePartida">
                        <i class="fa-solid fa-user-group"></i>
                        <p>Unirse</p>
                    </button>


                    <button type="button" class="btn contenedor-item border border-0" data-bs-toggle="modal" data-bs-target="#configuraciones">
                        <i class="fa-solid fa-volume-high"></i>
                        <p>Configuraciones</p>
                    </button>


                    <br>
                </div>
                <!-- estadisticas jugador -->
                <div class="row bajarResponsive">
                    <div class="col-12">

                        <div class="user-profile bg-white p-3 d-flex flex-column">
                            <!-- Botón de Cerrar Sesión -->
                            <div class="d-flex justify-content-end">
                                <form action="cerrarSesion.php" method="post">
                                    <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
                                </form>
                            </div>
                            <!-- Imagen y Nombre del Usuario en Flexbox -->
                            <div class="d-flex align-items-center mb-4">
                                <button type="button" class="btn border border-0" data-bs-toggle="modal" data-bs-target="#actulizarImagenPerfilModal">
                                    <?php
                                    if (!empty($resultado)) {
                                        // devuelve una fila en el resultado
                                        $usuarioID = $resultado[0]['usuarioID'];
                                        $urlImagen = $resultado[0]['url_imagen'];
                                        $nombre_imagen = $resultado[0]['nombre_imagen'];

                                        echo "<img src='" . htmlspecialchars($urlImagen) . "' alt='" . htmlspecialchars($nombre_imagen) . "' class='user-icon mr-3' id='imagenPerfilActual'/>";
                                    } else {
                                        exit();
                                    }
                                    ?>
                                </button>

                                <span id="nombreUsuarioDisplay" class="username"><?php echo $_SESSION['nombreUsuario']; ?></span>

                                <button type="button" class="btn  border-0 " data-bs-toggle="modal" data-bs-target="#actualizarNombreModal">
                                    <i class="fa-solid fa-user-pen iconoCamabiarNombre"></i>
                                </button>

                            </div>

                            <!-- Frase mitológica -->
                            <p class="motto">"El destino siempre sigue su curso." - Zeus</p>

                            <!-- Estadísticas en dos columnas -->
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <h5><i class="fas fa-bolt"></i> Partidas Ganadas:</h5>
                                    <?php
                                    if (!empty($partidas)) {

                                        $partidasGanadas = $partidas[0]['partidasGanadas'];

                                        echo "<p>$partidasGanadas<p>";
                                    } else {
                                        exit();
                                    }
                                    ?>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h5><i class="fas fa-skull"></i> Partidas Perdidas:</h5>
                                    <?php
                                    if (!empty($partidas)) {

                                        $partidasPerdidas = $partidas[0]['partidasPerdidas'];

                                        echo "<p>$partidasPerdidas<p>";
                                    } else {
                                        exit();
                                    }
                                    ?>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h5><i class="fas fa-chart-line"></i> Porcentaje de Victorias:</h5>
                                    <div class="progress barras">
                                        <div class="progress-bar porcentajePartidas" role="progressbar" style="width: <?php echo $porcentajeVictorias; ?>%;">
                                            <?php
                                            if ($totalPartidas > 0) {
                                                echo $porcentajeVictorias . "%";
                                            } else {
                                                echo $mensaje; // Mostrar mensaje solo si no hay partidas
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h5><i class="fas fa-chart-line-down"></i> Porcentaje de Derrotas:</h5>
                                    <div class="progress barras">
                                        <div class="progress-bar porcentajePartidas" role="progressbar" style="width: <?php echo $porcentajeDerrotas; ?>%;">
                                            <?php
                                            if ($totalPartidas > 0) {
                                                echo $porcentajeDerrotas . "%";
                                            } else {
                                                echo $mensaje;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="toast-container position-fixed bottom-0 end-0 ">
                <div id="liveToast" class="toast user-profile" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-transparent border-0">
                        <strong class="me-auto tituloAlertaBienvenida border-0">The God of the Whole</strong>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="toast" aria-label="Close">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="toast-body">
                        <i class="fas fa-crown"></i>
                        ¡Bienvenido, <?php echo $_SESSION['nombreUsuario']; ?>!
                    </div>
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
                                if (count($selectImagenes) > 0) {
                                    foreach ($selectImagenes as $fila) {
                                        $idUrl = $fila['id_url'];
                                        $urlImagen = $fila['url_imagen'];
                                        $nombreImagen = $fila['nombre_imagen'];

                                        echo "
        <div class='col-6 d-flex justify-content-center mb-3'>
            <input type='radio' id='imagen_$idUrl' name='imagen_id' value='$idUrl'>
            <label for='imagen_$idUrl' class='text-center'>
                <img src='" . htmlspecialchars($urlImagen) . "' alt='$nombreImagen' class='seleccionPerfilImagen'/>
                <br>
                <span>$nombreImagen</span>
            </label>
        </div>";
                                    }
                                } else {
                                    echo "<p>No hay imágenes disponibles.</p>";
                                }
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

        <!-- Modal de crear a partida -->
        <div class="modal fade" id="crearSala" tabindex="-1" aria-labelledby="crearSalaLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered  border-0">
                <div class="modal-content bg-transparent border-0">
                    <div class="modal-header border-0">

                    </div>
                    <div class="modal-body pergamino">
                        <form action="../sala/salaEsperaCreador.php" method="post" class="bajarFormulario">
                            <button type="button" class="text-white bg-transparent border-0 btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa-solid fa-x"></i>
                            </button>
                            <div class="col-2"></div>
                            <div class="mb-3 col-8">
                                <label for="txtNombreSala" class="form-label text-white">Nombre de la Sala <i class="fa-solid fa-door-open"></i></label>
                                <input type="text" class="form-control" name="txtNombreSala" id="txtNombreSala" placeholder="Escribe el nombre de la sala" required>
                            </div>
                            <div class="col-2"></div>
                            <div class="col-2"></div>
                            <div class="mb-3 col-8">
                                <label for="txtNumJugadores" class="form-label text-white">Número de Jugadores <i class="fa-solid fa-gamepad"></i></label>
                                <input type="number" class="form-control" name="txtNumJugadores" id="txtNumJugadores" placeholder="Máximo 4 jugadores" required min="2" max="4">
                            </div>
                            <div class="col-2"></div>
                            <div class="col2"></div>
                            <div class="col-8 border"></div>
                            <div class="col-2"></div>
                            <div class="modal-footer border-0">
                                <button type="submit" class="btn bg-transparent border-0">
                                    <img src="../img/botonCrearSala.png" alt="Crear Sala" class="img-fluid">
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de unirse a partida -->
        <div class="modal fade" id="unirsePartida" tabindex="-1" aria-labelledby="crearSalaLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered  border-0">
                <div class="modal-content bg-transparent border-0">
                    <div class="modal-header border-0">
                    </div>
                    <div class="modal-body pergamino">
                        <br>
                        <form action="salaEsperaInvitado.php" method="post" class="bajarFormulario">
                            <button type="button" class="text-white bg-transparent border-0 btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa-solid fa-x"></i>
                            </button>

                            <div class="col-2"></div>
                            <div class="mb-3 col-8">
                                <label for="txtNumJugadores" class="form-label text-white">Codigo de Sala <i class="fa-solid fa-gamepad"></i></label>
                                <input type="number" class="form-control" name="txtCodigoSala" id="txtCodigoSala" required>
                            </div>
                            <div class="col2"></div>
                            <div class="col-8 border"></div>
                            <div class="col-2"></div>
                            <div class="col-2"></div>
                            <div class="modal-footer border-0">
                                <button type="submit" class="btn bg-transparent border-0">
                                    <img src="../img/botonUnirse.png" alt="Crear Sala" class="img-fluid">
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal de configuraciones-->
        <div class="modal fade" id="configuraciones" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered  border-0">
                <div class="modal-content bg-transparent border-0">
                    <div class="modal-header border-0">

                    </div>
                    <div class="modal-body pergamino">
                        <form action="" method="">
                            <button type="button" class="text-white bg-transparent border-0 btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa-solid fa-x"></i>
                            </button>

                            <div class="col-12 col-md-12 row subir">
                                <div class="col-1"></div>
                                <div class="col-10">
                                    <h3 class="letra tipoLetra" style="margin-top: -10px;">General</h3> <!-- Ajusta el margen superior -->
                                    <input type="range" min="0" max="10" class="form-range" id="rangoGeneral" placeholder="rangoGeneral" />
                                </div>
                                <div class="col-1"></div>

                                <div class="col-1"></div>
                                <div class="col-10">
                                    <h3 class="tipoLetra" style="margin-top: -10px;">Música</h3> <!-- Ajusta el margen superior -->
                                    <input type="range" min="0" max="10" class="form-range" id="rangoMusica" placeholder="rangoMusica" />
                                </div>
                                <div class="col-1"></div>

                                <div class="col-1"></div>
                                <div class="col-10">
                                    <h3 class="tipoLetra" style="margin-top: -10px;">Voces</h3> <!-- Ajusta el margen superior -->
                                    <input type="range" min="0" max="10" class="form-range" id="rangoVoces" placeholder="rangoVoces" />
                                </div>
                                <div class="col-1"></div>
                            </div>



                            <div class="col-12 btn botonIngresar">
                                <button type="submit" class="bg-transparent border-0"><img
                                        src="../img/botonGuardar.png"
                                        alt="imagen de boton de guardar"
                                        class="img-fluid" /></button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de actualizar nombre -->
        <div class="modal fade" id="actualizarNombreModal" tabindex="-1" aria-labelledby="actualizarNombreLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content user-profile">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="actualizarNombreLabel">Actualizar Nombre</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formActualizarNombre" action="../libreria/acceso.php" method="POST">
                            <input type="hidden" name="usuarioID" id="usuarioID" value="<?php echo $_SESSION['usuarioID']; ?>">
                            <input type="text" name="nuevoNombre" id="nuevoNombre" placeholder="Nuevo nombre" class="rounded input-nombre" required>
                            <div class="modal-footer border-0 d-flex justify-content-center">
                                <button type="submit" class="btn border-0" id="actualizarNombreBtn">
                                    <img src="../img/botonGuardar.png" alt="Guardar" srcset="">
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <iframe id="musicaIframe" src="../musica/musicaJuego.html" allow="autoplay" style="display:none;"></iframe>
        <script src="../js/jQuery/jquery-3.6.0.min.js"></script> <!-- Primero carga jQuery -->
        <script src="../js/jQuery/jquery-migrate-3.5.0.min.js"></script> <!-- Luego jQuery Migrate -->
        <script src="../js/json/actualizarNombre.js"></script>
        <script src="../js/alertas/alertaBienvenida.js"></script>
        <script src="../js/json/actulizarImagenPerfil.js"></script>
</body>

</html>