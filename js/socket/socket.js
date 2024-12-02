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
      text.classList.add("other");
      text.innerText = `${data.autor}: ${data.mensaje}`;
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
    alert("No puedes enviar un mensaje vacío.");
    return;
  }

  document.getElementById("message").value = "";

  const text = document.createElement("div");
  text.classList.add("me");
  text.innerText = `Tú: ${message}`;
  document.getElementById("messages").appendChild(text);

  socket.send(
    JSON.stringify({
      tipo: "mensaje",
      codigoSala: codigoSala,
      mensaje: message,
    })
  );
});
