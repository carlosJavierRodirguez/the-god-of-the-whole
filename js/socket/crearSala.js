document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("formCrearSala");
  const inputCodigoSala = document.getElementById("txtCodigoSala");
  const userId = document.getElementById("userId").value; // Obtener el ID del usuario

  // Generar un código de sala aleatorio al cargar la página
  function generarCodigoSala() {
    let codigo = "";
    for (let i = 0; i < 5; i++) {
      let numeroAleatorio = Math.floor(Math.random() * 10);
      codigo += numeroAleatorio;
    }
    return codigo;
  }

  // Asignar el código generado al campo de texto oculto
  const codigoGenerado = generarCodigoSala();
  inputCodigoSala.value = codigoGenerado;

  form.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevenir el envío tradicional del formulario

    // Capturar los valores de los campos del formulario
    const nombreSala = document.getElementById("txtNombreSala").value;
    const codigoSala = inputCodigoSala.value; // Usar el valor generado

    // Validar los campos
    if (nombreSala.trim() !== "" && codigoSala.trim() !== "") {
      // Crear la conexión WebSocket
      const socket = new WebSocket("ws://localhost:8080");

      socket.onopen = () => {
        // Crear el mensaje que se enviará al servidor WebSocket
        const mensaje = {
          tipo: "crear_sala",
          nombreSala: nombreSala,
          codigoSala: codigoSala,
          userId: userId, // Incluir el ID del usuario que crea la sala
        };

        // Enviar el mensaje al servidor
        socket.send(JSON.stringify(mensaje));
        console.log(
          "Mensaje enviado al servidor WebSocket para crear la sala."
        );
      };

      socket.onmessage = (event) => {
        console.log("Respuesta recibida del servidor WebSocket:", event.data);
        const respuesta = JSON.parse(event.data);
        if (respuesta.status === "success") {
          window.location.href = "../sala/salaEsperaCreador.php";
        } else {
          alert(`Error: ${respuesta.mensaje}`);
        }
      };

      socket.onerror = (error) => {
        console.error("Error en la conexión WebSocket:", error);
        alert(
          "Hubo un problema al conectarse con el servidor. Inténtalo de nuevo más tarde."
        );
      };

      socket.onclose = () => {
        console.log("Conexión WebSocket cerrada.");
      };
    } else {
      alert("Por favor, ingresa un nombre de sala válido.");
    }
  });
});
