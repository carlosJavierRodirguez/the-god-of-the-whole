document.addEventListener("DOMContentLoaded", () => {
    enableDragReturn();
    enableClickReturn();
  });
  
  // Función para manejar el arrastre de los elementos de vuelta a su contenedor original
  function enableDragReturn() {
    const dragContainer = document.getElementById("drag-container");
  
    if (!dragContainer) {
      console.error("No se encontró el contenedor original.");
      return;
    }
  
    dragContainer.addEventListener("dragover", (event) => {
      event.preventDefault();
    });
  
    dragContainer.addEventListener("drop", (event) => {
      event.preventDefault();
      const draggedElementId = event.dataTransfer.getData("text/plain");
      const draggedElement = document.getElementById(draggedElementId);
  
      if (draggedElement) {
        dragContainer.appendChild(draggedElement);
        console.log(`Elemento ${draggedElementId} devuelto al contenedor original por arrastre.`);
      } else {
        console.error("Elemento arrastrado no encontrado.");
      }
    });
  }
  
  // Función para devolver el elemento al hacer clic en él
  function enableClickReturn() {
    const dropzone = document.getElementById("dropzone");
  
    if (!dropzone) {
      console.error("No se encontró el contenedor de la dropzone.");
      return;
    }
  
    dropzone.addEventListener("click", (event) => {
      const target = event.target.closest(".draggable");
  
      if (target) {
        const dragContainer = document.getElementById("drag-container");
  
        if (dragContainer) {
          dragContainer.appendChild(target);
          console.log(`Elemento ${target.id} devuelto al contenedor original por clic.`);
        } else {
          console.error("No se encontró el contenedor original para devolver el elemento.");
        }
      }
    });
  }