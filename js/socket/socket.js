import mostrarAlerta from "../alertas/mostrarAlertas.js";
export let unreadMessages = 0;
export let chatOpen = false;

// Función para actualizar el estado del chat
export function updateChatState(isOpen) {
  chatOpen = isOpen;
}

// Función para reiniciar el contador de mensajes no leídos
export function resetUnreadMessages() {
  unreadMessages = 0;
}

// Función para actualizar el badge de mensajes no leídos
export function updateMessageCount() {
  const messageCount = document.getElementById("messageCount");
  if (unreadMessages > 0) {
    messageCount.innerText = unreadMessages;
    messageCount.style.display = "inline";
  } else {
    messageCount.style.display = "none";
  }
}

// WebSocket configuración
const socket = new WebSocket("ws://localhost:8080");
const sendButton = document.getElementById("send");
const messageInput = document.getElementById("message");
const messagesContainer = document.getElementById("messages");

// Manejo de conexión WebSocket
socket.onopen = () => {
  console.log("Conectado al servidor WebSocket");
};

// Manejo de mensajes entrantes
socket.onmessage = (event) => {
  try {
    const data = JSON.parse(event.data);

    switch (data.tipo) {
      case "mensaje":
        // Solo procesar mensajes de otros clientes
        if (data.autor !== "Tú") {
          const text = document.createElement("div");
          text.classList.add("other");
          text.innerText = `${data.autor}: ${data.mensaje}`;

          // Incrementar contador de mensajes no leídos si el chat está cerrado
          if (!chatOpen) {
            unreadMessages++;
            updateMessageCount();
          }

          messagesContainer.appendChild(text);
        }
        break;

      case "confirmacion_envio":
        // Confirmación de envío para el cliente actual
        console.log("Confirmación de envío:", data.mensaje);
        break;

      default:
        console.log("Tipo de mensaje no reconocido:", data.tipo);
    }
  } catch (error) {
    console.error("Error procesando el mensaje recibido:", error);
  }
};

// Función para manejar el envío de mensajes
function handleSendMessage() {
  const message = messageInput.value.trim();

  if (message === "") {
    mostrarAlerta("error", "Error", "El mensaje no puede estar vacío.", "");
    return;
  }

  // Limpia el campo de entrada
  messageInput.value = "";

  // Agrega el mensaje localmente (sin duplicar)
  const text = document.createElement("div");
  text.classList.add("me");
  text.innerText = `Tú: ${message}`;
  messagesContainer.appendChild(text);

  // Envía el mensaje a través del WebSocket
  socket.send(
    JSON.stringify({
      tipo: "mensaje",
      mensaje: message,
    })
  );
}

// Asegurar que el evento solo se registre una vez
if (sendButton) {
  sendButton.removeEventListener("click", handleSendMessage); // Elimina cualquier listener previo
  sendButton.addEventListener("click", handleSendMessage); // Registra el nuevo listener
}

// Manejo de desconexión
socket.onclose = () => {
  console.log("Desconexión del servidor WebSocket");
};

// Manejo de errores
socket.onerror = (error) => {
  console.error("Error en el WebSocket:", error);
};
