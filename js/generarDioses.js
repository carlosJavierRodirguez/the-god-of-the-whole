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

  // 3. Genera los elementos de los dioses en una sola fila
  initializeRow(dragContainer, gods);

  // 4. Configura la zona de soltado
  setupDropzone();
});

// Función para inicializar una sola fila
function initializeRow(container, gods) {
  const rowDiv = document.createElement("div");
  rowDiv.className = "row d-flex justify-content-center"; // Asegura alineación horizontal

  gods.forEach((godName, index) => {
    const godDiv = createGodElement(godName, index);
    rowDiv.appendChild(godDiv);
  });

  container.appendChild(rowDiv);
}

// Función para crear un elemento (dios)
function createGodElement(godName, index) {
  const godDiv = document.createElement("div");
  godDiv.className = ` draggable ${godName}`;
  godDiv.id = `item${index + 1}`;
  godDiv.draggable = true;
  godDiv.textContent = godName; // Opcional, para mostrar el nombre del dios

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

  // Ajusta la posición relativa al contenedor de la zona de drop
  const rect = dropzone.getBoundingClientRect();
  const offsetX = event.clientX - rect.left;
  const offsetY = event.clientY - rect.top;

  draggedElement.style.position = "relative";
  draggedElement.style.left = `${offsetX - draggedElement.offsetLeft}px`;
  draggedElement.style.top = `${offsetY - draggedElement.offsetTop}px`;

  dropzone.appendChild(draggedElement);
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
