document.addEventListener("DOMContentLoaded", async () => {
    const preguntaContainer = document.getElementById("pregunta");
    const dragContainer = document.getElementById("drag-container");

    try {
        // Llamar al endpoint PHP para obtener la pregunta e imágenes
        const response = await fetch(`../js/juego-js/dragDrop/parametros.php`);
        const data = await response.json();

        if (data.error) {
            throw new Error(data.error);
        }

        // Mostrar la pregunta
        if (preguntaContainer) {
            preguntaContainer.textContent = data.pregunta; // Actualizar el texto con la pregunta recibida
        }

        // Verificar si hay imágenes disponibles
        const imagenes = data.imagenes;
        if (imagenes.length === 0) {
            throw new Error("No se encontraron imágenes.");
        }

        dragContainer.innerHTML = ""; // Limpiar contenedor antes de agregar imágenes

        // Crear elementos para cada imagen
        imagenes.forEach((imagen, index) => {
            // Crear un contenedor para cada imagen
            const imgDiv = document.createElement("div");
            imgDiv.className = "draggable text-center";
            imgDiv.id = `item${index + 1}`;
            imgDiv.draggable = true;

            // Crear el elemento de imagen
            const imgElement = document.createElement("img");
            imgElement.src = imagen.imagen_url; // URL de la imagen
            imgElement.alt = imagen.nombre; // Nombre de la imagen
            imgElement.className = "img-dios";

            // Crear el texto del nombre debajo de la imagen
            const nameElement = document.createElement("p");
            nameElement.textContent = imagen.nombre;
            nameElement.className = "nombre-dios";

            // Añadir la imagen y el texto al contenedor
            imgDiv.appendChild(imgElement);
            imgDiv.appendChild(nameElement);
            dragContainer.appendChild(imgDiv);

            // Añadir eventos para arrastrar
            imgDiv.addEventListener("dragstart", (event) => {
                event.dataTransfer.setData("text/plain", imgDiv.id);
                console.log(`Inicio de arrastre: ${imgDiv.id}`);
            });

            imgDiv.addEventListener("dragend", () => {
                console.log(`Fin de arrastre: ${imgDiv.id}`);
            });
        });

        console.log(`Se configuraron ${imagenes.length} elementos para arrastrar.`);
    } catch (error) {
        console.error("Error al cargar los datos:", error);
        if (preguntaContainer) {
            preguntaContainer.textContent = "Error al cargar la pregunta.";
        }
    }
});