<?php
include('convertor.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Imagen</title>
</head>
<body>

<h2>Cargar Imagen de Dios</h2>

<form action="convertor.php" method="POST" enctype="multipart/form-data">
    <label for="imagen">Selecciona una imagen:</label>
    <input type="file" name="imagen" id="imagen" required>
    <button type="submit">Cargar Imagen</button>
</form>

</body>
</html>