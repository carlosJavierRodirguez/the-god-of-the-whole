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
  const rowConfig = [6, 4];

  // 3. Inicializa las filas y elementos
  initializeRows(dragContainer, gods, rowConfig);

  // 4. Configura la zona de soltado
  setupDropzone();
});

// Función para inicializar las filas y elementos
function initializeRows(container, gods, rowConfig) {
  let godIndex = 0;

  rowConfig.forEach((rowSize) => {
    const rowDiv = createRow();
    for (let i = 0; i < rowSize; i++) {
      if (godIndex >= gods.length) break;
      const godDiv = createGodElement(gods[godIndex], godIndex, rowSize);
      rowDiv.appendChild(godDiv);
      godIndex++;
    }
    container.appendChild(rowDiv);
  });
}

// Función para crear una fila
function createRow() {
  const rowDiv = document.createElement("div");
  rowDiv.className = "row";
  return rowDiv;
}

// Función para crear un elemento (dios)
function createGodElement(godName, index, rowSize) {
  const godDiv = document.createElement("div");
  godDiv.className = `col-1 draggable ${godName}`;
  godDiv.id = `item${index + 1}`;
  godDiv.draggable = true;

  // Almacena datos necesarios para el posicionamiento original
  godDiv.dataset.index = index;
  godDiv.dataset.rowSize = rowSize;

  // Eventos de arrastre
  godDiv.addEventListener("dragstart", handleDragStart);
  godDiv.addEventListener("dragend", handleDragEnd);

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

  // Ajusta la posición relativa
  const rect = dropzone.getBoundingClientRect();
  const offsetX = event.clientX - rect.left;
  const offsetY = event.clientY - rect.top;

  // En lugar de cambiar a posición absoluta
  draggedElement.style.position = "relative";
  draggedElement.style.left = `${offsetX - draggedElement.offsetLeft}px`;
  draggedElement.style.top = `${offsetY - draggedElement.offsetTop}px`;

  dropzone.appendChild(draggedElement);
}

// Función para devolver la posición original
function returnToOriginalPosition(event) {
  const draggedElement = event.target;
  const originalIndex = draggedElement.dataset.index;
  const originalRowSize = draggedElement.dataset.rowSize;
  const rowDivs = document
    .getElementById("drag-container")
    .getElementsByClassName("row");

  const originalRowDiv = rowDivs[Math.floor(originalIndex / originalRowSize)];
  if (originalRowDiv) {
    originalRowDiv.appendChild(draggedElement);
    draggedElement.style.position = "";
    draggedElement.style.left = "";
    draggedElement.style.top = "";
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
