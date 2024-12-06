// Inicializa la conexión WebSocket
const socket = new WebSocket("ws://localhost:8080");

// Configura los eventos del WebSocket
socket.onopen = () => {
  console.log("Conexión WebSocket establecida");
};

socket.onerror = (error) => {
  console.error("Error en la conexión WebSocket:", error);
};

socket.onmessage = (event) => {
  console.log("Mensaje recibido del servidor:", event.data);

  try {
    const mensaje = JSON.parse(event.data);

    if (mensaje.tipo === "usuarios_en_sala") {
      // Renderiza la lista de usuarios conectados
      const listaUsuarios = document.getElementById("lista-usuarios");
      listaUsuarios.innerHTML = ""; // Limpia la lista existente

      mensaje.usuarios.forEach((usuario) => {
        const divUserProfile = document.createElement("div");
        divUserProfile.className = "user-profile form-group mt-2 rounded";

        const button = document.createElement("button");
        button.type = "button";
        button.className = "btn border-0 border seleccionPerfilImagen";

        const img = document.createElement("img");
        img.className = "user-icon";
        img.src = usuario.url_imagen;
        img.alt = usuario.nombre_imagen;

        const span = document.createElement("span");
        span.className = "username";
        span.textContent = usuario.nombre_invitado;

        button.appendChild(img);
        divUserProfile.appendChild(button);
        divUserProfile.appendChild(span);

        listaUsuarios.appendChild(divUserProfile);
      });
    }
  } catch (error) {
    console.error("Error al procesar el mensaje del servidor:", error);
  }
};
