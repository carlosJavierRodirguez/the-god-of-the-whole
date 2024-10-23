function iniciarTransicion() {
  // Muestra el iframe
  const iframe = document.getElementById("iframe-cargando");
  iframe.style.display = "block";

  // Espera 6 segundos y redirige a la siguiente página
  setTimeout(() => {
    window.location.href = "../juego/juego.php"; // Cambia a la página que necesites
  }, 5250); // 6000 milisegundos = 6 segundos
}

// Tiempo inicial del contador
let tiempo = 5;

// Función que actualiza el contador
function iniciarContador() {
  const contadorElemento = document.getElementById("contador");

  // Intervalo que reduce el contador cada segundo
  const intervalo = setInterval(() => {
    // Actualizar el texto del contador
    contadorElemento.textContent = tiempo;

    // Reducir el tiempo
    tiempo--;

    // Cuando el contador llega a 0, se detiene el intervalo
    if (tiempo < 0) {
      clearInterval(intervalo);
      contadorElemento.textContent = "0";
      // Aquí puedes añadir alguna acción al finalizar el conteo
    }
  }, 1000);
}

// Inicia el contador cuando se carga la página
window.onload = iniciarContador;
