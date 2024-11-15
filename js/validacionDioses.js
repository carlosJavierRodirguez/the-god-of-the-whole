document.addEventListener("DOMContentLoaded", () => {
    const diosesVerdaderos = ["afrodita", "apolo", "ares", "artemisa", "atenea", "hades", "hefesto", "hera", "poseidon", "zeus"];
    const semiDioses = ["gemini", "hercules"];
    const criaturasMitologicas = ["griffo", "minotauro", "sirenas"];
    const dragContainer = document.getElementById("drag-container");

    // Función para validar los elementos en la zona de drop
    function validarDioses() {
        const elementosDropzone = document.querySelectorAll("#dropzone .draggable");
        let cantidadDiosesValidos = 0;
        let hayDiosesInvalidos = false;

        // Recorremos todos los elementos en la zona de drop
        elementosDropzone.forEach(elemento => {
            const claseDios = Array.from(elemento.classList).find(cls =>
                diosesVerdaderos.includes(cls) || semiDioses.includes(cls) || criaturasMitologicas.includes(cls)
            );

            // Si el dios es verdadero, incrementamos el contador de dioses válidos
            if (diosesVerdaderos.includes(claseDios)) {
                elemento.style.backgroundColor = "green"; // Color para dioses verdaderos
                elemento.style.borderRadius = "60%"; // Borde redondeado
                cantidadDiosesValidos++;
            } 
            // Si el dios es semiDios o criatura mitológica, lo marcamos como inválido
            else if (semiDioses.includes(claseDios) || criaturasMitologicas.includes(claseDios)) {
                elemento.style.backgroundColor = "red"; // Color para elementos incorrectos
                elemento.style.borderRadius = "60%"; // Borde redondeado
                hayDiosesInvalidos = true;
            }
        });

        // Devolvemos true si hay al menos 4 dioses válidos y no hay dioses inválidos
        return cantidadDiosesValidos >= 4 && !hayDiosesInvalidos;
    }

    // Función para mostrar alerta personalizada
function mostrarAlerta(mensaje, esValido) {
    const alertContainer = document.getElementById("alert-container");
    
    // Crear el div de alerta
    const alerta = document.createElement("div");
    alerta.classList.add("alert", "alert-dismissible", "fade", "show");
    alerta.classList.add(esValido ? "alert-success" : "alert-danger"); // Cambiar el color según si es válido o no
    alerta.style.backgroundImage = "url('../img/texturaMarmol.jpg')"; // Imagen de fondo
    alerta.style.backgroundSize = "cover";
    alerta.style.backgroundPosition = "center"; // Asegurarse de que la imagen cubra todo el área
    alerta.style.color = "black"; // Color blanco para el texto
    alerta.style.position = "fixed"; // Fija la alerta en la pantalla
    alerta.style.top = "10px"; // Colocarla cerca de la parte superior
    alerta.style.left = "50%"; // Centrarla horizontalmente
    alerta.style.transform = "translateX(-50%)"; // Ajustar para un centrado perfecto
    alerta.style.zIndex = "1050"; // Asegurar que esté encima de otros elementos
    alerta.style.borderRadius = "10px"; // Borde redondeado de la alerta
    
    alerta.innerHTML = `
        <strong>${esValido ? "¡Éxito!" : "Error:"}</strong> ${mensaje}
        <button type="button" class="btn-close" aria-label="Close"></button>
    `;

    // Agregar el evento de cierre
const closeButton = alerta.querySelector(".btn-close");
closeButton.addEventListener("click", () => {
    alerta.classList.remove("show"); // Esconde la alerta
    alerta.classList.add("fade"); // Añadir fade para la animación
    setTimeout(() => alerta.remove(), 500); // Eliminar la alerta después de la animación
});

// Agregar la alerta al contenedor
alertContainer.appendChild(alerta);
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
                // Si hay al menos 4 dioses válidos y no hay dioses inválidos, redirigir
                window.location.href = "pantallaCarga.php";
            } else {
                // Si hay dioses inválidos o menos de 4 dioses válidos, mostrar un error
                mostrarAlerta("Error: Debes tener al menos 4 dioses correctos en la zona de drop. Revisa tu selección.");
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