<!DOCTYPE html>
<html lang="es">

<head>
  <?php include('principal/head.php'); ?>
  <link rel="stylesheet" href="css/estilosJuego.css"/>
</head>

<body class="pantano">
  <div class="container-fluid">

    <!-- Encabezado de la ronda y tiempo -->
    <div class="muro">
      <div class="texto1">
        <h2>Ronda: 2</h2>
        <p>Tiempo: 5:00</p>
        <p>¿Qué dioses se consideran olímpicos?</p>
      </div>
    </div>

    <!-- Conjunto A: Personaje mostrado -->
    <div class="pergaminoveneno">
      <h5></h5>
      <div class="espadas"></div>
    </div>

    <!-- Botones de estado -->


    <!-- Selección de personajes/dioses -->
    <div class="row my-4 justify-content-center">
      <div class="col-6 col-md-4 text-center mb-4">
        <img src="ruta-imagen-afrodita" alt="Afrodita" class="img-fluid">
        <p>Afrodita</p>
      </div>
      <div class="col-6 col-md-4 text-center mb-4">
        <img src="ruta-imagen-hera" alt="Hera" class="img-fluid">
        <p>Hera</p>
      </div>
      <div class="col-6 col-md-4 text-center mb-4">
        <img src="ruta-imagen-atenea" alt="Atenea" class="img-fluid">
        <p>Atenea</p>
      </div>
      <!-- Repetir para los demás personajes -->
    </div>

  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>