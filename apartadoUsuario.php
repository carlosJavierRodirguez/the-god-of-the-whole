<?php
session_start(); // Esto debe estar en la primera línea del archivo
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('principal/head.php') ?>
    <link rel="stylesheet" href="./css/estilosUSer.css">
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
                        <i class="fa-solid fa-gear"></i>
                        <p>Configuraciones</p>
                    </button>


                    <br>
                </div>

                <div class="row bajarResponsive">
                    <div class="col-12">
                        <div class="user-profile bg-white p-3">
                            <!-- Imagen y Nombre del Usuario en Flexbox -->
                            <div class="d-flex align-items-center mb-4">
                                <button type="button" class="btn border border-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <img src="img/afrodita.png" alt="Afrodita" class="user-icon mr-3">
                                </button>
                                <span class="username" id="NombreJugador">
                                    Carlos Javier Rodriguez
                                    <button type="button" class="btn border border-0">
                                        <i class="fa-solid fa-user-pen"></i>
                                    </button>
                                </span>
                            </div>

                            <!-- Frase mitológica -->
                            <p class="motto">"El destino siempre sigue su curso." - Zeus</p>

                            <!-- Estadísticas en dos columnas -->
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <h5><i class="fas fa-bolt"></i> Partidas Ganadas:</h5>
                                    <p>10</p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h5><i class="fas fa-skull"></i> Partidas Perdidas:</h5>
                                    <p>5</p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h5><i class="fas fa-chart-line"></i> Porcentaje de Victorias:</h5>
                                    <div class="progress barras">
                                        <div class="progress-bar  victorias" role="progressbar">
                                            66%
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h5><i class="fas fa-chart-line-down"></i> Porcentaje de Derrotas:</h5>
                                    <div class="progress barras">
                                        <div class="progress-bar  derrotas" role="progressbar">
                                            33%
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para escoger la imagen de perfil -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content user-profile ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Selecciona tu Imagen de Perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <p>Elige una imagen que te represente en el juego:</p>
                    <form action="guardar_imagen.php" method="post">
                        <div class="row">
                            <div class="col-6 d-flex justify-content-center mb-3">
                                <input type="radio" id="imagen1" name="imagen_id" value="1" required>
                                <label for="imagen1" class="text-center" style="cursor: pointer;">
                                    <img src="img/afrodita.png" alt="Imagen 1" class="selecionPerfilImagen" />
                                    <span>Imagen 1</span>
                                </label>
                            </div>
                            <div class="col-6 d-flex justify-content-center mb-3">
                                <input type="radio" id="imagen2" name="imagen_id" value="2" required>
                                <label for="imagen2" class="text-center" style="cursor: pointer;">
                                    <img src="img/ares.png" alt="Imagen 2" class="selecionPerfilImagen" />
                                    <span>Imagen 2</span>
                                </label>
                            </div>
                            <div class="col-6 d-flex justify-content-center mb-3">
                                <input type="radio" id="imagen3" name="imagen_id" value="3" required>
                                <label for="imagen3" class="text-center" style="cursor: pointer;">
                                    <img src="img/atenea.png" alt="Imagen 3" class="selecionPerfilImagen" />
                                    <span>Imagen 3</span>
                                </label>
                            </div>
                            <div class="col-6 d-flex justify-content-center mb-3">
                                <input type="radio" id="imagen4" name="imagen_id" value="4" required>
                                <label for="imagen4" class="text-center" style="cursor: pointer;">
                                    <img src="img/gemini.png" alt="Imagen 4" class="selecionPerfilImagen" />
                                    <span>Imagen 4</span>
                                </label>
                            </div>
                            <div class="col-6 d-flex justify-content-center mb-3">
                                <input type="radio" id="imagen5" name="imagen_id" value="5" required>
                                <label for="imagen5" class="text-center" style="cursor: pointer;">
                                    <img src="img/poseidon.png" alt="Imagen 5" class="selecionPerfilImagen" />
                                    <span>Imagen 5</span>
                                </label>
                            </div>
                            <div class="col-6 d-flex justify-content-center mb-3">
                                <input type="radio" id="imagen6" name="imagen_id" value="6" required>
                                <label for="imagen6" class="text-center" style="cursor: pointer;">
                                    <img src="img/hera.png" alt="Imagen 6" class="selecionPerfilImagen" />
                                    <span>Imagen 6</span>
                                </label>
                            </div>
                        </div>

                        <div class="modal-footer border-0">
                            <button type="submit" class="btn border-0 ">
                                <img src="img/botonGuardar.png" alt="" srcset="">
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
                    <form action="salaEsperaCreador.php" method="post" class="bajarFormulario">
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
                                <img src="img/botonCrearSala.png" alt="Crear Sala" class="img-fluid">
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
                                <img src="img/botonUnirse.png" alt="Crear Sala" class="img-fluid">
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
                    <form action="" method="get">
                        <button type="button" class="text-white bg-transparent border-0 btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-x"></i>
                        </button>

                        <div class="col-12 col-md-12 row">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <br>
                                <h3 class="letra tipoLetra">General</h3>
                                <input type="range" min="0" max="10" class="form-range rango text-danger" id="rangoGeneral" placeholder="rangoGeneral" />
                            </div>
                            <div class="col-2"></div>
                            <div class="col-2"></div>
                            <div class="col-8">
                                <h3 class="tipoLetra">Música</h3>
                                <input type="range" min="0" max="10" class="form-range rango text-danger" id="rangoMusica" placeholder="rangoMusica" />
                            </div>
                            <div class="col-2"></div>
                            <div class="col-2"></div>
                            <div class="col-8">
                                <h3 class="tipoLetra">Voces</h3>
                                <input type="range" min="0" max="10" class="form-range rango text-danger" id="rangoVoces" placeholder="rangoVoces" />
                            </div>
                            <div class="col-2"></div>
                        </div>

                        <div class="col-12 btn botonIngresar">
                            <button type="submit" class="bg-transparent border-0"><img
                                    src="img/botonGuardar.png"
                                    alt="imagen de boton de guardar"
                                    class="img-fluid" /></button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</body>




</html>