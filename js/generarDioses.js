document.addEventListener("DOMContentLoaded", () => {
  // 1. Mezcla el array de dioses
  let gods = shuffleArray([
    "hades",
    "poseidon",
    "gemini",
    "sirenas",
    "zeus",
    "apolo",
    "hefesto",
    "artemisa",
    "minotauro",
    "griffo",
  ]);

  // 2. Configuración del contenedor
  const dragContainer = document.getElementById("drag-container");

  // 3. Genera los elementos de los dioses
  initializeRow(dragContainer, gods);

  // 4. Configura la zona de soltado
  setupDropzone();
});

// Función para inicializar una fila con elementos
function initializeRow(container, gods) {
  gods.forEach((godName, index) => {
    const godDiv = createGodElement(godName, index);
    
    // Guardar la posición original del elemento
    godDiv.dataset.originalParent = container.id;
    container.appendChild(godDiv);
  });
}

// Función para crear un elemento de dios
function createGodElement(godName, index) {
  const godDiv = document.createElement("div");
  godDiv.className = `draggable ${godName}`;
  godDiv.id = `item${index + 1}`;
  godDiv.draggable = true;
  godDiv.textContent = godName; // Opcional, para mostrar el nombre del dios

  // Eventos de arrastre
  godDiv.addEventListener("dragstart", handleDragStart);
  godDiv.addEventListener("dragend", handleDragEnd);

  // Evento para devolver al contenedor inicial al hacer clic
  godDiv.addEventListener("dblclick", () => {
    devolverAlContenedorInicial(godDiv);
  });

  return godDiv;
}

// Configura la zona de soltado
function setupDropzone() {
  const dropzone = document.getElementById("dropzone");

  dropzone.addEventListener("dragover", (event) => {
    event.preventDefault();
  });

  dropzone.addEventListener("drop", (event) => {
    event.preventDefault();
    handleDrop(event, dropzone);
  });
}

// Función para manejar el evento de soltado
function handleDrop(event, dropzone) {
  const id = event.dataTransfer.getData("text/plain");
  const draggedElement = document.getElementById(id);

  // Ajustar estilos de posición
  draggedElement.style.position = "";
  draggedElement.style.left = "";
  draggedElement.style.top = "";

  dropzone.appendChild(draggedElement);
}

// Función para devolver el elemento al contenedor inicial
function devolverAlContenedorInicial(elemento) {
  const originalParentId = elemento.dataset.originalParent;
  const originalParent = document.getElementById(originalParentId);

  if (originalParent) {
    // Restablecer cualquier estilo personalizado
    elemento.style.position = "";
    elemento.style.left = "";
    elemento.style.top = "";

    // Agregar el elemento al contenedor inicial
    originalParent.appendChild(elemento);
  }
}

// Función para mezclar el array de dioses
function shuffleArray(array) {
  for (let i = array.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [array[i], array[j]] = [array[j], array[i]];
  }
  return array;
}

// Funciones de manejo de arrastre
function handleDragStart(event) {
  event.dataTransfer.setData("text/plain", event.target.id);
  setTimeout(() => event.target.classList.add("invisible"), 0);
}

function handleDragEnd(event) {
  event.target.classList.remove("invisible");
}