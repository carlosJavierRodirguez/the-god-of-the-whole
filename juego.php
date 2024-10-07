<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('principal/head.php') ?>

  <link rel="stylesheet" href="css/estilosJuego.css" /> 
    
  <div class="container">
  <!-- Encabezado de la ronda y tiempo -->
  <div class="row"> 
    <div class="col text-center">
      <img src="img/Pergamino-juego-head.png" alt="pergamino" class="pergamino-head">
      <div class="texto-encima1">
       <h2>Ronda 1</h2>
       <p>Tiempo: 5:00</p>
       <p class="preguntas1">¿Que dioses se consideran olimpicos?</p>
      </div>
    </div>
  </div>

  <!-- Conjunto A: Personaje mostrado -->
  <div class="row">
    <div class="col text-center">
      <div class="card">
        <div class="card-body">
          <h5>Conjunto A</h5>
          <p>Poseidón</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabla de posiciones -->
  <div class="row my-4">
    <div class="col text-center">
      <div class="card">
        <div class="card-body">
          <h6>Top 1: ProMaster31</h6>
          <h6>Top 2: ChigüiroAzul</h6>
          <h6>Top 3: Manzana334</h6>
        </div>
      </div>
    </div>
  </div>

  <!-- Botones de estado -->
  <div class="row">
    <div class="col text-center">
      <button class="btn btn-success">¿Terminaste?</button>
      <button class="btn btn-danger">Listo</button>
    </div>
  </div>

  <!-- Selección de personajes/dioses -->
  <div class="row my-4">
    <!-- Utilizando col-auto para ajustarse al tamaño del contenido -->
    <div class="col-auto">
      <img src="ruta-imagen-afrodita" alt="Afrodita" class="img-fluid">
      <p>Afrodita</p>
    </div>
    <div class="col-auto">
      <img src="ruta-imagen-hera" alt="Hera" class="img-fluid">
      <p>Hera</p>
    </div>
    <div class="col-auto">
      <img src="ruta-imagen-atenea" alt="Atenea" class="img-fluid">
      <p>Atenea</p>
    </div>
    <!-- Repetir para los demás personajes -->
  </div>
</div>