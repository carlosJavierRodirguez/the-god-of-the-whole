document.addEventListener("DOMContentLoaded", () => {
    const dropzone = document.getElementById("dropzone");

    dropzone.addEventListener("dragover", (event) => {
        event.preventDefault(); // Permitir que se pueda soltar en la zona
    });

    dropzone.addEventListener("drop", (event) => {
        event.preventDefault(); // Prevenir el comportamiento predeterminado
        const id = event.dataTransfer.getData("text/plain");
        const draggedElement = document.getElementById(id);

        // Colocar el elemento en la posición del cursor al soltar
        const rect = dropzone.getBoundingClientRect();
        const offsetX = event.clientX - rect.left;
        const offsetY = event.clientY - rect.top;

        draggedElement.style.position = "absolute"; // Cambiar posición a absoluta
        draggedElement.style.left = `${offsetX}px`;
        draggedElement.style.top = `${offsetY}px`;

        dropzone.appendChild(draggedElement); // Mover el elemento a la dropzone
    });

    // Hacer que los elementos del dropzone puedan ser arrastrados de vuelta al contenedor original
    const originalContainer = document.getElementById("drag-container");

    originalContainer.addEventListener("dragover", (event) => {
        event.preventDefault();
    });

    originalContainer.addEventListener("drop", (event) => {
        event.preventDefault();
        const id = event.dataTransfer.getData("text/plain");
        const draggedElement = document.getElementById(id);

        // Colocar el elemento en su posición original
        originalContainer.appendChild(draggedElement);
        
        // Resetear la posición para que esté en el flujo normal del layout
        draggedElement.style.position = "static";
    });
});