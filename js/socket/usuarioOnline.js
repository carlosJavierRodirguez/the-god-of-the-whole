const socket = new WebSocket("ws://localhost:8080");

socket.onopen = () => {
  console.log("Conectado al servidor WebSocket");
};

socket.onmessage = (event) => {
  console.log("Mensaje recibido:", event.data);

  try {
    const data = JSON.parse(event.data);

    if (data.type === "usuarios_en_sala") {
      console.log(`Usuarios en la sala ${data.codigoSala}:`, data.usuarios);
      console.table(data.usuarios);

      // Actualiza la lista de usuarios en la interfaz
      const listaUsuarios = document.getElementById("lista-usuarios");
      if (listaUsuarios) {
        listaUsuarios.innerHTML = ""; // Limpia la lista actual
        data.usuarios.forEach((usuario) => {
          const li = document.createElement("li");
          li.textContent = usuario;
          listaUsuarios.appendChild(li);
        });
      }
    }
  } catch (error) {
    console.error("Error procesando el mensaje:", error);
  }
};

socket.onerror = (error) => {
  console.error("Error en el WebSocket:", error);
};

socket.onclose = () => {
  console.log("Conexión cerrada.");
};
