document.addEventListener("DOMContentLoaded", () => {
    const gods = [
        "hera", "afrodita", "ares", "atenea", "hercules",
        "hades", "poseidon", "gemini", "sirenas", "zeus",
        "apolo", "hefesto", "artemisa", "minotauro", "griffo"
    ];

    const correctGods = ["hera", "afrodita", "ares", "zeus"]; // Dioses correctos

    const dragContainer = document.getElementById("drag-container");
    const rowConfig = [5, 5, 5]; // Configuración de columnas por fila

    let godIndex = 0;

    rowConfig.forEach(rowSize => {
        const rowDiv = document.createElement("div");
        rowDiv.className = "row";

        for (let i = 0; i < rowSize; i++) {
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

function handleDragStart(e) {
    e.dataTransfer.setData("text/plain", e.target.id);
    setTimeout(() => e.target.classList.add("invisible"), 0);
}

function handleDragEnd(e) {
    e.target.classList.remove("invisible");
}