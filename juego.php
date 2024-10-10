<!DOCTYPE html>
<html lang="es">

<head>
  <?php include('principal/head.php'); ?>
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
    <div class="row pergaminoveneno ">
      <div class="col-12 text-center">
        <div class="espadas"></div>
      </div>
    </div>

    <!-- Sección adicional vacía -->
    <div class="row arboles">
      <div class="col-12">

       <div class="row my-4 justify-content-center">
         <div class="col-6 col-md-4 text-center mb-4">
          <p><div class="afrodita"></div></p>
         </div>

           <div class="col-6 col-md-4 text-center mb-4">
            <p><div class="hera"></div></p>
         </div>

         <div class="col-6 col-md-4 text-center mb-4">
         <p><div class="atenea"></div></p>
      </div>

       </div>
      </div>
    </div>

  <!-- Scripts de Bootstrap y Popper -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>