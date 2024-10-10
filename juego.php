<!DOCTYPE html>
<html lang="es">

<head>
  <?php include('principal/head.php'); ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/estilosJuego.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
</head>

<body class="pantano">
  <div class="container-fluid">

    <!-- Encabezado de la ronda y tiempo -->
    <div class="row muro">
      <div class="col-12 texto1 text-center">
        <h2>Ronda: 2</h2>
        <p>Tiempo: 5:00</p>
        <p>¿Qué dioses se consideran olímpicos?</p>
      </div>
    </div>

    <!-- Sección con el personaje mostrado en pergamino veneno -->
    <div class="row pergaminoveneno">
      <div class="col-12 text-center">
        <div class="espadas"></div>
      </div>
    </div>

    <!-- Apartado 4x4 de imágenes -->
    <div class="row my-4 image-grid">
      <div class="col-3">
        <img src="../img/image1.png" class="img-fluid" >
      </div>
      <div class="col-3">
        <img src="../img/image2.png" class="img-fluid" >
      </div>
      <div class="col-3">
        <img src="../img/image3.png" class="img-fluid" >
      </div>
      <div class="col-3">
        <img src="../img/image4.png" class="img-fluid" >
      </div>
      <div class="col-3">
        <img src="../img/image5.png" class="img-fluid" >
      </div>
      <div class="col-3">
        <img src="../img/image6.png" class="img-fluid" >
      </div>
      <div class="col-3">
        <img src="../img/image7.png" class="img-fluid" >
      </div>
      <div class="col-3">
        <img src="../img/image8.png" class="img-fluid" >
      </div>
    </div>

  <!-- Scripts de Bootstrap y Popper -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>