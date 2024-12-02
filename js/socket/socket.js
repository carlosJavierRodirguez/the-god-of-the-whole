import mostrarAlerta from "../alertas/mostrarAlertas.js";
const socket = new WebSocket("ws://localhost:8080");

socket.onopen = () => {
  console.log("Conectado al servidor WebSocket");
};

socket.onclose = (event) => {
  if (event.wasClean) {
    console.log("Conexión cerrada limpiamente");
  } else {
    console.log("Conexión cerrada inesperadamente");
  }
};

socket.onerror = (error) => {
  console.error("Error en la conexión WebSocket:", error);
};

socket.onmessage = (event) => {
  try {
    const data = JSON.parse(event.data);

    if (data.tipo === "mensaje") {
      const text = document.createElement("div");

      if (data.esTuMensaje) {
        text.classList.add("me"); // Mensaje propio
        text.innerText = `Tú: ${data.mensaje}`;
      } else {
        text.classList.add("other"); // Mensaje de otro usuario
        text.innerText = `${data.autor}: ${data.mensaje}`;
      }

      document.getElementById("messages").appendChild(text);
    } else {
      console.log("Mensaje no reconocido:", data);
    }
  } catch (error) {
    console.error("Error procesando el mensaje recibido:", error);
  }
};

document.getElementById("send").addEventListener("click", () => {
  const message = document.getElementById("message").value.trim();
  const codigoSala = document.getElementById("sala")?.value || ""; // Opcional para salas

  if (message === "") {
    mostrarAlerta(
      "error",
      "No puedes enviar un mensaje vacío.",
      "El mensaje no puede estar vacío.",
      ""
    );
    return;
  }

  document.getElementById("message").value = "";

  const text = document.createElement("div");
  text.classList.add("me"); // Mensaje propio
  text.innerText = `Tú: ${message}`;

  socket.send(
    JSON.stringify({
      tipo: "mensaje",
      codigoSala: codigoSala,
      mensaje: message,
    })
  );
});
