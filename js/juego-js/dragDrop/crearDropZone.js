document.addEventListener("DOMContentLoaded", () => {
  createDropzoneGrid();
});

function createDropzoneGrid() {
  const dropzone = document.getElementById("dropzone");

  dropzone.style.display = "grid";
  dropzone.style.gridTemplateColumns = "repeat(5, 1fr)";
  dropzone.style.gridTemplateRows = "repeat(2, 1fr)";
  dropzone.style.gap = "10px";

  for (let i = 0; i < 10; i++) {
    const cell = document.createElement("div");
    cell.classList.add("drop-cell");
    cell.dataset.cellIndex = i + 1;
    cell.style.border = "2px dashed #ccc";
    cell.style.height = "100px";
    cell.style.width = "100px";
    cell.style.display = "flex";
    cell.style.justifyContent = "center";
    cell.style.alignItems = "center";

    cell.addEventListener("dragover", handleDragOver);
    cell.addEventListener("drop", handleDrop);
    dropzone.appendChild(cell);
  }
}

function handleDragOver(event) {
  event.preventDefault();
}

function handleDrop(event) {
  event.preventDefault();
  const draggedElementId = event.dataTransfer.getData("text/plain");
  const draggedElement = document.getElementById(draggedElementId);

  if (!draggedElement) {
    console.error(`Elemento arrastrado no encontrado: ${draggedElementId}`);
    return; // Salir si el elemento no se encuentra
  }

  if (!event.target.hasChildNodes()) {
    event.target.appendChild(draggedElement);
    draggedElement.style.position = "relative";
    draggedElement.style.margin = "0 auto";
    console.log(`Elemento ${draggedElementId} colocado en la celda.`);
  } else {
    console.warn("La celda ya tiene un elemento.");
  }
}