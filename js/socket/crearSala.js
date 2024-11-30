document.addEventListener("DOMContentLoaded", async function () {
  const form = document.getElementById("formCrearSala");
  const inputCodigoSala = document.getElementById("txtCodigoSala");
  const userId = document.getElementById("usuarioId").value; 

  // Función para generar un código aleatorio
  function generarCodigo() {
    let codigo = "";
    for (let i = 0; i < 5; i++) {
      let numeroAleatorio = Math.floor(Math.random() * 10);
      codigo += numeroAleatorio;
    }
    return codigo;
  }

  // Función para verificar si el código ya existe en la base de datos
  async function verificarCodigoEnBD(codigo) {
    try {
      const response = await fetch(
        "../libreria/validarCodigos/codigoSala.php",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({ codigo }),
        }
      );

      const data = await response.json();
      return !data.existe; // Devuelve true si no existe
    } catch (error) {
      console.error("Error al verificar el código:", error);
      return false; // En caso de error, considerar el código no válido
    }
  }

  // Generar un código único
  async function generarCodigoUnico() {
    let codigoValido = false;
    let codigo;

    while (!codigoValido) {
      codigo = generarCodigo(); // Generar un código
      codigoValido = await verificarCodigoEnBD(codigo); // Verificar en la base de datos
    }

    return codigo;
  }

  // Asignar el código único generado al campo de texto oculto
  const codigoGenerado = await generarCodigoUnico();
  inputCodigoSala.value = codigoGenerado;

  // Manejar el envío del formulario
  form.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevenir el envío tradicional del formulario

    // Capturar los valores de los campos del formulario
    const nombreSala = document.getElementById("txtNombreSala").value;
    const codigoSala = inputCodigoSala.value; // Usar el código generado
    const usuarioId = document.getElementById("usuarioId"); //id de del usuario

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
          usuarioId: userId, 
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
