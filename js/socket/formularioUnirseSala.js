document
  .getElementById("btnIngresarSala")
  .addEventListener("click", function (event) {
    // Prevenir el comportamiento predeterminado del formulario
    event.preventDefault();

    // Capturar los valores del formulario
    const nombreJugador = document.getElementById("txtNombreJugador").value;
    const codigoSala = document.getElementById("txtCodigoSala").value;

    // Validar los campos (puedes agregar más validaciones si lo deseas)
    if (nombreJugador.length >= 3 && codigoSala.length >= 5) {
      // Establecer la conexión al WebSocket
      conectarWebSocket(codigoSala, nombreJugador);
    } else {
      alert("Por favor, complete correctamente los campos.");
    }
  });

function conectarWebSocket(codigoSala, nombreJugador) {
  const socket = new WebSocket("ws://localhost:8080"); // Reemplaza 'PORT' con tu puerto WebSocket.

  socket.onopen = () => {
    // Enviar el código de la sala y el nombre del jugador al servidor WebSocket
    const mensaje = JSON.stringify({
      tipo: "conectar_sala",
      sala: codigoSala,
      jugador: nombreJugador,
    });
    socket.send(mensaje);
    console.log(
      "Conectado al servidor WebSocket y enviado el código de sala y nombre del jugador."
    );
  };

  socket.onmessage = (event) => {
    const data = JSON.parse(event.data);
    // Manejar mensajes recibidos desde el servidor
    console.log("Mensaje recibido:", data);
  };

  socket.onclose = () => {
    console.log("Conexión cerrada.");
  };

  socket.onerror = (error) => {
    console.error("Error en la conexión:", error);
  };
}
