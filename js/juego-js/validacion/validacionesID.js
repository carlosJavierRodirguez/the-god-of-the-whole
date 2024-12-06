// Archivo: validacionesID.js

// Obtener los datos de la pregunta y sus imágenes desde parametros.php
async function obtenerParametros() {
    try {
        const response = await fetch('../dragDrop/parametros.php'); // Ruta ajustada según la estructura de carpetas
        const data = await response.json();

        if (data.error) {
            console.error('Error al obtener parámetros:', data.error);
            return null;
        }

        return data;
    } catch (error) {
        console.error('Error al obtener parámetros:', error);
        return null;
    }
}

// Validar las respuestas seleccionadas contra la pregunta y sus imágenes correctas
async function validarRespuestas(idsImagenesSeleccionadas) {
    const parametros = await obtenerParametros();

    if (!parametros) {
        Swal.fire({
            title: 'Error',
            text: 'No se pudo cargar la pregunta. Por favor, inténtalo más tarde.',
            icon: 'error',
        });
        return 0;
    }

    const imagenesCorrectas = parametros.imagenes.map(imagen => imagen.imagen_id);
    let puntos = 0;

    idsImagenesSeleccionadas.forEach(idImagen => {
        if (imagenesCorrectas.includes(idImagen)) {
            puntos += 10; // Imagen correcta
        } else {
            puntos -= 5; // Imagen incorrecta
        }
    });

    return { puntos, preguntaId: parametros.pregunta_id };
}

// Función para capturar dinámicamente los IDs de las imágenes seleccionadas
function obtenerIdsSeleccionados() {
    const elementosDropzone = document.querySelectorAll("#dropzone .draggable");
    return Array.from(elementosDropzone).map(el => parseInt(el.dataset.id)); // Supone que los IDs están en data-id
}

// Función para mostrar el modal con los puntos obtenidos y actualizar el puntaje global
function mostrarModalPuntos(puntos) {
    // Obtener el puntaje total acumulado desde localStorage
    let puntajeTotal = parseInt(localStorage.getItem('puntajeTotal')) || 0;

    // Actualizar el puntaje total acumulado
    puntajeTotal += puntos;
    localStorage.setItem('puntajeTotal', puntajeTotal);

    Swal.fire({
        title: puntos >= 0 ? '¡Ronda finalizada!' : '¡Atención!',
        html: `
            <p>${puntos >= 0 
                ? `Has obtenido <strong>${puntos} puntos</strong> en esta ronda.` 
                : `Has perdido puntos. Puntos totales: <strong>${puntajeTotal}</strong>`}</p>
            <p><strong>Puntaje acumulado:</strong> ${puntajeTotal} puntos</p>
        `,
        icon: puntos >= 0 ? 'success' : 'error',
        timer: 5000, // Modal se cierra automáticamente después de 5 segundos
        showConfirmButton: false,
        allowOutsideClick: false,
        didClose: () => {
            // Llama automáticamente a la función para avanzar de ronda cuando el modal se cierra
            avanzarRondaDesdeDioses();
        },
    });
}

// Uso del validador en el evento de validación
document.addEventListener("DOMContentLoaded", async () => {
    const validateButton = document.getElementById("validateButton");

    if (validateButton) {
        validateButton.addEventListener("click", async (event) => {
            event.preventDefault();

            // IDs de imágenes seleccionadas (capturados dinámicamente)
            const idsImagenesSeleccionadas = obtenerIdsSeleccionados();

            const { puntos, preguntaId } = await validarRespuestas(idsImagenesSeleccionadas);

            // Mostrar el modal con los puntos obtenidos y actualizar el puntaje global
            mostrarModalPuntos(puntos);

            console.log(`Pregunta ID: ${preguntaId}, Puntos obtenidos: ${puntos}`);
        });
    }
});