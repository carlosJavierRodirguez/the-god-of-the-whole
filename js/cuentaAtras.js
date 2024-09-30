function cuentaRegresiva() {
  let tiempoRestante = 10 * 60; // Convertir minutos a segundos

  const intervalo = setInterval(() => {
    // Calcular minutos y segundos
    const minutos = Math.floor(tiempoRestante / 60);
    const segundos = tiempoRestante % 60;

    // Formatear el tiempo en MM:SS
    const tiempoFormateado = `${minutos.toString().padStart(2, "0")}:${segundos
      .toString()
      .padStart(2, "0")}`;

    // Asignar el tiempo formateado al contador con el HTML
    document.getElementById("contador").innerHTML =
      '<h5 class="text-white">' + tiempoFormateado + "</h5>";

    // Reducir el tiempo restante
    tiempoRestante--;

    // Detener el intervalo cuando se llegue a 0
    if (tiempoRestante < 0) {
      clearInterval(intervalo);
      document.getElementById("contador").innerHTML =
        '<h5 class="text-white">¡Tiempo terminado!</h5>';
    }
  }, 1000); // 1000 ms = 1 segundo
}
