document.addEventListener("DOMContentLoaded", () => {
    const diosesVerdaderos = ["afrodita", "apolo", "ares", "artemisa", "atenea", "hades", "hefesto", "hera", "poseidon", "zeus"];
    const semiDioses = ["gemini", "hercules"];
    const criaturasMitologicas = ["griffo", "minotauro", "sirenas"];
    const dragContainer = document.getElementById("drag-container");

    // Función para validar los elementos en la zona de drop
    function validarDioses() {
        const elementosDropzone = document.querySelectorAll("#dropzone .draggable");
        let todosCorrectos = true;

        elementosDropzone.forEach(elemento => {
            const claseDios = Array.from(elemento.classList).find(cls =>
                diosesVerdaderos.includes(cls) || semiDioses.includes(cls) || criaturasMitologicas.includes(cls)
            );

            if (diosesVerdaderos.includes(claseDios)) {
                elemento.style.backgroundColor = "green"; // Color para dioses verdaderos
                elemento.style.borderRadius = "60%"; // Borde redondeado
            } else if (semiDioses.includes(claseDios) || criaturasMitologicas.includes(claseDios)) {
                elemento.style.backgroundColor = "red"; // Color para elementos incorrectos
                elemento.style.borderRadius = "60%"; // Borde redondeado
                todosCorrectos = false;
            }
        });

        if (todosCorrectos) {
            window.location.href = "pagina_correcta.html";
        } else {
            alert("Error: Hay elementos que no son dioses verdaderos. Revisa tu selección.");
        }
    }

    // Función para restablecer el color y devolver el elemento al contenedor inicial
    function devolverAlContenedorInicial(elemento) {
        elemento.style.backgroundColor = ""; // Restablecer color
        elemento.style.borderRadius = ""; // Restablecer borde
        dragContainer.appendChild(elemento); // Devolver al contenedor inicial
    }

    // Agregar evento de clic al botón de validación
    const validateButton = document.getElementById("validateButton");
    if (validateButton) {
        validateButton.addEventListener("click", validarDioses);
    } else {
        console.error("El botón de validación no se encontró en el DOM.");
    }

    // Escuchar el evento dragend para restablecer el color cuando el elemento se suelta fuera del dropzone
    const elementosDraggables = document.querySelectorAll(".draggable");
    elementosDraggables.forEach(elemento => {
        elemento.addEventListener("dragend", () => {
            if (!elemento.closest("#dropzone")) {
                elemento.style.backgroundColor = "";
                elemento.style.borderRadius = ""; // Restablecer borde
            }
        });

        // Evento de clic para devolver el elemento al contenedor inicial si está en el dropzone
        elemento.addEventListener("click", () => {
            if (elemento.closest("#dropzone")) {
                devolverAlContenedorInicial(elemento);
            }
        });
    });
});