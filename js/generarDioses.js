document.addEventListener("DOMContentLoaded", () => {
    let gods = [
        "hera", "afrodita", "ares", "atenea", "hercules",
        "hades", "poseidon", "gemini", "sirenas", "zeus",
        "apolo", "hefesto", "artemisa", "minotauro", "griffo"
    ];

    const rowConfig = [5, 5, 5]; // Configuración de columnas por fila

    // Mezcla aleatoria del array de dioses
    gods = shuffleArray(gods);

    const dragContainer = document.getElementById("drag-container");
    let godIndex = 0;

    // Crear el contenedor de dioses
    rowConfig.forEach(rowSize => {
        const rowDiv = document.createElement("div");
        rowDiv.className = "row";

        for (let iteracion = 0; iteracion < rowSize; iteracion++) {
            if (godIndex >= gods.length) break;

            const godDiv = document.createElement("div");
            godDiv.className = `col-3 draggable ${gods[godIndex]}`;
            godDiv.id = `item${godIndex + 1}`;
            godDiv.draggable = true;

            // Guardar la posición original (en relación al contenedor)
            godDiv.dataset.index = godIndex; // Almacena el índice original
            godDiv.dataset.rowSize = rowSize; // Almacena el tamaño de la fila

            godDiv.addEventListener("dragstart", handleDragStart);
            godDiv.addEventListener("dragend", handleDragEnd);

            rowDiv.appendChild(godDiv);
            godIndex++;
        }

        dragContainer.appendChild(rowDiv);
    });

    const dropzone = document.getElementById("dropzone");

    dropzone.addEventListener("dragover", (elementos) => {
        elementos.preventDefault(); // Permitir que se pueda soltar en la zona
    });

    dropzone.addEventListener("drop", (elementos) => {
        elementos.preventDefault(); // Prevenir el comportamiento predeterminado
        const id = elementos.dataTransfer.getData("text/plain");
        const draggedElement = document.getElementById(id);
        
        // Colocar el elemento en la posición del cursor al soltar
        const rect = dropzone.getBoundingClientRect();
        const offsetX = elementos.clientX - rect.left;
        const offsetY = elementos.clientY - rect.top;

        draggedElement.style.position = "absolute"; // Cambiar posición a absoluta
        draggedElement.style.left = `${offsetX}px`;
        draggedElement.style.top = `${offsetY}px`;

        dropzone.appendChild(draggedElement); // Mover el elemento a la dropzone

        // Agregar un evento de clic para devolver la imagen a su posición original
        draggedElement.addEventListener("click", returnToOriginalPosition);
    });

    // Evento para manejar si se suelta fuera de la dropzone
    document.addEventListener("dragend", (elementos) => {
        if (!dropzone.contains(elementos.target)) {
            const originalIndex = elementos.target.dataset.index;
            const originalRowSize = elementos.target.dataset.rowSize;
            const rowDivs = dragContainer.getElementsByClassName("row");
            
            // Obtener el div de la fila original
            const originalRowDiv = rowDivs[Math.floor(originalIndex / originalRowSize)];
            const originalPositionInRow = originalIndex % originalRowSize;

            // Reubicar el elemento en su posición original
            if (originalRowDiv) {
                originalRowDiv.appendChild(elementos.target);
            }
        }
    });
});

// Función para devolver la imagen a su posición original
function returnToOriginalPosition(event) {
    const draggedElement = event.target;
    const originalIndex = draggedElement.dataset.index;
    const originalRowSize = draggedElement.dataset.rowSize;
    const rowDivs = document.getElementById("drag-container").getElementsByClassName("row");

    // Obtener el div de la fila original
    const originalRowDiv = rowDivs[Math.floor(originalIndex / originalRowSize)];

    // Reubicar el elemento en su posición original
    if (originalRowDiv) {
        originalRowDiv.appendChild(draggedElement);
        // Opcional: restablecer el estilo de posición
        draggedElement.style.position = "";
        draggedElement.style.left = "";
        draggedElement.style.top = "";
    }
}

// Función para mezclar el array de dioses aleatoriamente
function shuffleArray(array) {
    for (let iteracion = array.length - 1; iteracion > 0; iteracion--) {
        const iterar2 = Math.floor(Math.random() * (iteracion + 1));
        [array[iteracion], array[iterar2]] = [array[iterar2], array[iteracion]]; // Intercambio de elementos
    }
    return array;
}

function handleDragStart(elementos) {
    elementos.dataTransfer.setData("text/plain", elementos.target.id);
    setTimeout(() => elementos.target.classList.add("invisible"), 0);
}

function handleDragEnd(elementos) {
    elementos.target.classList.remove("invisible");
}