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

    rowConfig.forEach(rowSize => {
        const rowDiv = document.createElement("div");
        rowDiv.className = "row";

        for (let iterar = 0; iterar < rowSize; iterar++) {
            if (godIndex >= gods.length) break;

            const godDiv = document.createElement("div");
            godDiv.className = `col-3 draggable ${gods[godIndex]}`;
            godDiv.id = `item${godIndex + 1}`;
            godDiv.draggable = true;

            godDiv.addEventListener("dragstart", handleDragStart);
            godDiv.addEventListener("dragend", handleDragEnd);

            rowDiv.appendChild(godDiv);
            godIndex++;
        }

        dragContainer.appendChild(rowDiv);
    });
});

// Función para mezclar el array de dioses aleatoriamente
function shuffleArray(array) {
    for (let iterar = array.length - 1; iterar > 0; iterar--) {
        const iteraciones = Math.floor(Math.random() * (iterar + 1));
        [array[iterar], array[iteraciones]] = [array[iteraciones], array[iterar]]; // Intercambio de elementos
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