document.addEventListener("DOMContentLoaded", () => {
    const dropzone = document.getElementById("dropzone");
    const validateButton = document.getElementById("validateButton");

    // Rutas válidas
    const correctPath = "ruta/a/diosesVerdaderos/"; // Cambia esto a la ruta correcta
    const incorrectPaths = [
        "ruta/a/semiDioses/", // Cambia esto a la ruta correcta
        "ruta/a/criaturasMitologicas/" // Cambia esto a la ruta correcta
    ];

    // Mantener la lista de dioses arrastrados
    let draggedGods = [];

    // Evento para manejar el drop en la dropzone
    dropzone.addEventListener("dragover", (event) => {
        event.preventDefault(); // Permitir el drop
    });

    dropzone.addEventListener("drop", (event) => {
        event.preventDefault();
        const data = event.dataTransfer.getData("text/plain");

        // Verifica si el dato es un ID de un dios
        if (data) {
            const godElement = document.getElementById(data);
            if (godElement) {
                dropzone.appendChild(godElement);
                draggedGods.push(godElement); // Agregar a la lista de dioses arrastrados
                console.log(`Dios arrastrado: ${data}`); // Depuración
            }
        }
    });

    // Validación al hacer clic en el botón
    validateButton.addEventListener("click", () => {
        let correctCount = 0;

        // Validar las imágenes de los dioses arrastrados
        draggedGods.forEach(god => {
            const backgroundImage = god.style.backgroundImage;

            // Asegúrate de que el backgroundImage esté definido
            if (backgroundImage) {
                console.log(`Verificando: ${backgroundImage}`); // Depuración

                // Verificar si la imagen proviene de la carpeta "diosesVerdaderos"
                if (backgroundImage.includes(correctPath)) {
                    correctCount++;
                    console.log(`Dios correcto: ${god.id}`); // Depuración
                }

                // Verificar si la imagen proviene de las carpetas incorrectas
                incorrectPaths.forEach(path => {
                    if (backgroundImage.includes(path)) {
                        correctCount--; // Restar si es de una carpeta incorrecta
                        console.log(`Dios incorrecto: ${god.id}`); // Depuración
                    }
                });
            }
        });

        // Verificación final y redirección
        console.log(`Total correcto: ${correctCount}`); // Depuración

        // Si hay exactamente 4 dioses correctos
        if (correctCount === 4) {
            // Redirigir a la otra página
            window.location.href = "ruta/a/la/siguiente/pagina.html"; // Cambia esta ruta según corresponda
        } else {
            // Mostrar mensaje de error
            alert("Respuesta incorrecta. Asegúrate de arrastrar los dioses correctos.");
        }
    });
});