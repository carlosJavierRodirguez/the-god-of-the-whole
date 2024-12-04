document.addEventListener("DOMContentLoaded", async () => {
    const preguntaContainer = document.getElementById("woodquest"); // Ahora busca el id directamente
    const dragContainer = document.getElementById("drag-container");

    try {
        // Llamar al endpoint PHP
        const response = await fetch(`../js/juego-js/dragDrop/parametros.php`);
        const data = await response.json();

        if (data.error) {
            throw new Error(data.error);
        }

        // Mostrar la pregunta en el contenedor
        if (preguntaContainer) {
            preguntaContainer.innerHTML = `
                <h1 class="pregunta-texto text-center">${data.pregunta}</h1>
                <p id="contador" class="text-center">Tiempo restante: 20s</p>
            `;
        }

        // Generar las imágenes en un grid de 2 filas y 5 columnas
        const imagenes = data.imagenes;
        if (imagenes.length === 0) {
            throw new Error("No se encontraron imágenes.");
        }

        dragContainer.innerHTML = ""; // Limpiar contenedor antes de añadir elementos

        imagenes.forEach((imagen, index) => {
            // Crear contenedor para la imagen
            const imgDiv = document.createElement("div");
            imgDiv.className = "draggable text-center";
            imgDiv.id = `item${index + 1}`;
            imgDiv.draggable = true;

            // Crear la imagen
            const imgElement = document.createElement("img");
            imgElement.src = imagen.imagen_url;
            imgElement.alt = imagen.nombre;
            imgElement.className = "img-thumbnail";

            // Crear el texto debajo de la imagen
            const nameElement = document.createElement("p");
            nameElement.textContent = imagen.nombre;
            nameElement.className = "nombre-dios";

            // Añadir la imagen y el texto al contenedor
            imgDiv.appendChild(imgElement);
            imgDiv.appendChild(nameElement);
            dragContainer.appendChild(imgDiv);

            // Añadir eventos de arrastrar
            imgDiv.addEventListener("dragstart", handleDragStart);
            imgDiv.addEventListener("dragend", handleDragEnd);
        });
    } catch (error) {
        console.error("Error al cargar los datos:", error);
        if (preguntaContainer) {
            preguntaContainer.innerHTML = `
                <h1 class="text-danger text-center">Error al cargar los datos.</h1>
            `;
        }
    }
});

// Eventos de arrastre
function handleDragStart(event) {
    event.dataTransfer.setData("text/plain", event.target.id);
    setTimeout(() => event.target.classList.add("invisible"), 0);
}

function handleDragEnd(event) {
    event.target.classList.remove("invisible");
}