import {
  resetUnreadMessages,
  updateMessageCount,
  updateChatState,
} from "../socket/socket.js";

const chatModal = document.getElementById("chatModal");
const chatModalHeader = document.getElementById("chatModalHeader");
const closeModalButton = document.querySelector(".chat-close-btn");

let isDragging = false;
let offsetX, offsetY;

// Función para abrir el modal
export function openChatModal() {
  updateChatState(true); // Actualiza el estado del chat como abierto
  resetUnreadMessages(); // Reinicia el contador de mensajes no leídos
  updateMessageCount(); // Oculta el badge de mensajes no leídos

  chatModal.style.display = "block";
  chatModal.style.left = "50%";
  chatModal.style.top = "50%";
  chatModal.style.transform = "translate(-50%, -50%)";
}

// Función para cerrar el modal
export function closeChatModal() {
  updateChatState(false); // Actualiza el estado del chat como cerrado
  chatModal.style.display = "none";
}

// Manejo del botón de cierre del modal
closeModalButton.addEventListener("click", closeChatModal);

// Función para iniciar el arrastre del modal
chatModalHeader.addEventListener("mousedown", (e) => {
  isDragging = true;
  offsetX = e.clientX - chatModal.getBoundingClientRect().left;
  offsetY = e.clientY - chatModal.getBoundingClientRect().top;
  document.addEventListener("mousemove", dragModal);
  document.addEventListener("mouseup", stopDragging);
});

// Función para mover el modal
function dragModal(e) {
  if (isDragging) {
    chatModal.style.left = `${e.clientX - offsetX}px`;
    chatModal.style.top = `${e.clientY - offsetY}px`;
    chatModal.style.transform = "none"; // Elimina cualquier transformación previa
  }
}

// Función para detener el arrastre
function stopDragging() {
  isDragging = false;
  document.removeEventListener("mousemove", dragModal);
  document.removeEventListener("mouseup", stopDragging);
}
