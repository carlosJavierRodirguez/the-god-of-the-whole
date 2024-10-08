<!DOCTYPE html>
<html lang="es">

<head>
  <?php include('principal/head.php'); ?>
  <link rel="stylesheet" href="css/estilosJuego.css" />
</head>

<body>
  <div class="container">

    <!-- Encabezado de la ronda y tiempo -->
    <div class="pergamino-head">
      <div class="texto1">
        <h2>Ronda 1</h2>
        <p>Tiempo: 5:00</p>
        <p>¿Qué dioses se consideran olímpicos?</p>
      </div>
    </div>

    <!-- Conjunto A: Personaje mostrado -->
    <div class="circulo-de-1">
      <div class="card text-center">
        <div class="card-body">
          <h5>Conjunto A</h5>
          <p>Poseidón</p>
        </div>
      </div>
    </div>

    <!-- Tabla de posiciones -->
    <div class="my-4 text-center">
      <div class="card">
        <div class="card-body">
          <h6>Top 1: ProMaster31</h6>
          <h6>Top 2: ChigüiroAzul</h6>
          <h6>Top 3: Manzana334</h6>
        </div>
      </div>
    </div>

    <!-- Botones de estado -->
    <div class="text-center">
      <button class="btn btn-success">¿Terminaste?</button>
      <button class="btn btn-danger">Listo</button>
    </div>

    <!-- Selección de personajes/dioses -->
    <div class="row my-4 justify-content-center">
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
</body>
</html>