const socket = new WebSocket("ws://localhost:8080");

socket.onopen = () => {
  console.log("Conectado al servidor WebSocket");
};

socket.onmessage = (event) => {
  const data = JSON.parse(event.data);
  console.log("Mensaje recibido del servidor:", data);

  if (data.type === "usuarios_en_sala") {
    console.log(`Usuarios en la sala ${data.codigoSala}:`, data.usuarios);
    console.table(data.usuarios);

    const listaUsuarios = document.getElementById("lista-usuarios");
    if (listaUsuarios) {
      listaUsuarios.innerHTML = "";
      data.usuarios.forEach((usuario) => {
        const li = document.createElement("li");
        li.textContent = usuario;
        listaUsuarios.appendChild(li);
      });
    } else {
      console.warn("Elemento #lista-usuarios no encontrado en el DOM.");
    }
  } else {
    console.log("Mensaje no relacionado con usuarios en sala:", data);
  }
};

socket.onerror = (error) => {
  console.error("Error en el WebSocket:", error);
};

socket.onclose = () => {
  console.log("Conexión cerrada.");
};
