document.addEventListener("DOMContentLoaded", () => {
  const dropzone = document.getElementById("dropzone");
  const originalContainer = document.getElementById("drag-container");

  // Agregar eventos a la dropzone
  dropzone.addEventListener("dragover", (event) => {
    event.preventDefault(); // Permitir el "drop"
    dropzone.classList.add("highlight"); // Añadir clase para resaltar
  });

  dropzone.addEventListener("dragleave", () => {
    dropzone.classList.remove("highlight"); // Quitar clase al salir
  });

  dropzone.addEventListener("drop", (event) => {
    event.preventDefault(); // Prevenir comportamiento predeterminado
    dropzone.classList.remove("highlight"); // Quitar resalte

    const id = event.dataTransfer.getData("text/plain");
    const draggedElement = document.getElementById(id);

    // Calcular la posición donde soltar
    const rect = dropzone.getBoundingClientRect();
    const offsetX = event.clientX - rect.left;
    const offsetY = event.clientY - rect.top;

    draggedElement.style.position = "absolute"; // Cambiar posición a absoluta
    draggedElement.style.left = `${offsetX}px`;
    draggedElement.style.top = `${offsetY}px`;

    dropzone.appendChild(draggedElement); // Mover el elemento a la dropzone
  });

  // Agregar eventos para permitir devolver elementos al contenedor original
  originalContainer.addEventListener("dragover", (event) => {
    event.preventDefault();
    originalContainer.classList.add("highlight"); // Resaltar contenedor
  });

  originalContainer.addEventListener("dragleave", () => {
    originalContainer.classList.remove("highlight"); // Quitar resalte
  });

  originalContainer.addEventListener("drop", (event) => {
    event.preventDefault();
    originalContainer.classList.remove("highlight"); // Quitar resalte

    const id = event.dataTransfer.getData("text/plain");
    const draggedElement = document.getElementById(id);

    // Devolver el elemento al contenedor original
    originalContainer.appendChild(draggedElement);
    draggedElement.style.position = "relative"; // Cambiar a relativa
    draggedElement.style.left = ""; // Resetear estilos
    draggedElement.style.top = "";
  });

  // Agregar eventos a cada elemento draggable
  const draggableElements = document.querySelectorAll(".draggable");
  draggableElements.forEach((element) => {
    element.addEventListener("dragstart", (event) => {
      event.dataTransfer.setData("text/plain", event.target.id);
      setTimeout(() => event.target.classList.add("invisible"), 0);
    });

    element.addEventListener("dragend", (event) => {
      event.target.classList.remove("invisible");
    });
  });
});
