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

    dropzone.addEventListener("dragover", (e) => {
        e.preventDefault(); // Permitir que se pueda soltar en la zona
    });

    dropzone.addEventListener("drop", (e) => {
        e.preventDefault(); // Prevenir el comportamiento predeterminado
        const id = e.dataTransfer.getData("text/plain");
        const draggedElement = document.getElementById(id);
        dropzone.appendChild(draggedElement); // Mover el elemento a la dropzone
    });

    // Evento para manejar si se suelta fuera de la dropzone
    document.addEventListener("dragend", (e) => {
        if (!dropzone.contains(e.target)) {
            const originalIndex = e.target.dataset.index;
            const originalRowSize = e.target.dataset.rowSize;
            const rowDivs = dragContainer.getElementsByClassName("row");
            
            // Obtener el div de la fila original
            const originalRowDiv = rowDivs[Math.floor(originalIndex / originalRowSize)];
            const originalPositionInRow = originalIndex % originalRowSize;

            // Reubicar el elemento en su posición original
            if (originalRowDiv) {
                originalRowDiv.appendChild(e.target);
            }
        }
    });
});

// Función para mezclar el array de dioses aleatoriamente
function shuffleArray(array) {
    for (let iteracion = array.length - 1; iteracion > 0; iteracion--) {
        const j = Math.floor(Math.random() * (iteracion + 1));
        [array[iteracion], array[j]] = [array[j], array[iteracion]]; // Intercambio de elementos
    }
    return array;
}

function handleDragStart(e) {
    e.dataTransfer.setData("text/plain", e.target.id);
    setTimeout(() => e.target.classList.add("invisible"), 0);
}

function handleDragEnd(e) {
    e.target.classList.remove("invisible");
}