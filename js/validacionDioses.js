document.addEventListener("DOMContentLoaded", () => {
    const diosesVerdaderos = ["afrodita", "apolo", "ares", "artemisa", "atenea", "hades", "hefesto", "hera", "poseidon", "zeus"];
    const semiDioses = ["gemini", "hercules"];
    const criaturasMitologicas = ["griffo", "minotauro", "sirenas"];
    const dragContainer = document.getElementById("drag-container");

    // Función para validar los elementos en la zona de drop
    function validarDioses() {
        const elementosDropzone = document.querySelectorAll("#dropzone .draggable");
        let diosesValidos = false;
        let diosesInvalidos = false;

        // Recorremos todos los elementos en la zona de drop
        elementosDropzone.forEach(elemento => {
            const claseDios = Array.from(elemento.classList).find(cls =>
                diosesVerdaderos.includes(cls) || semiDioses.includes(cls) || criaturasMitologicas.includes(cls)
            );

            // Si el dios es verdadero, marcamos el dios como válido
            if (diosesVerdaderos.includes(claseDios)) {
                elemento.style.backgroundColor = "green"; // Color para dioses verdaderos
                elemento.style.borderRadius = "60%"; // Borde redondeado
                diosesValidos = true;
            } 
            // Si el dios es semiDios o criatura mitológica, lo marcamos como inválido
            else if (semiDioses.includes(claseDios) || criaturasMitologicas.includes(claseDios)) {
                elemento.style.backgroundColor = "red"; // Color para elementos incorrectos
                elemento.style.borderRadius = "60%"; // Borde redondeado
                diosesInvalidos = true;
            }
        });

        // Devolvemos si hay dioses válidos y no hay dioses inválidos
        return diosesValidos && !diosesInvalidos;
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
        validateButton.addEventListener("click", function(event) {
            // Prevenir la acción por defecto del enlace y evitar redirección inmediata
            event.preventDefault();

            // Validar dioses en la zona de drop
            const diosesValidados = validarDioses();

            if (diosesValidados) {
                // Si hay dioses válidos y no hay dioses inválidos, redirigir
                window.location.href = "pantallaCarga.php";
            } else {
                // Si hay dioses inválidos o no hay dioses válidos, mostrar un error
                alert("Error: Hay dioses incorrectos en la zona de drop. Revisa tu selección.");
            }
        });
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