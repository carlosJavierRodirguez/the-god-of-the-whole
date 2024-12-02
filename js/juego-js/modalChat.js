const chatModal = document.getElementById("chatModal");
const chatModalHeader = document.getElementById("chatModalHeader");

let isDragging = false;
let offsetX, offsetY;

// Función para iniciar el arrastre
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
    chatModal.style.transform = "none"; // Asegura que no haya transformaciones conflictivas
  }
}

// Función para detener el arrastre
function stopDragging() {
  isDragging = false;
  document.removeEventListener("mousemove", dragModal);
  document.removeEventListener("mouseup", stopDragging);
}

// Mostrar el modal
function openChatModal() {
  chatModal.style.display = "block";
  chatModal.style.left = "50%"; // Posiciona al centro inicial
  chatModal.style.top = "50%";
  chatModal.style.transform = "translate(-50%, -50%)";
}

// Cerrar el modal
document.querySelector(".chat-close-btn").addEventListener("click", () => {
  chatModal.style.display = "none";
});
