document.addEventListener("DOMContentLoaded", () => {
    // Lista de nombres de clases correspondientes a cada categoría
    const diosesVerdaderos = ["afrodita", "apolo", "ares", "artemisa", "atenea", "hades", "hefesto", "hera", "poseidon", "zeus"];
    const semiDioses = ["gemini", "hercules"];
    const criaturasMitologicas = ["griffo", "minotauro", "sirenas"];

    // Función para validar los elementos en la zona de drop
    function validarDioses() {
        const elementosDropzone = document.querySelectorAll("#dropzone .draggable");
        let todosCorrectos = true;

        // Verificar cada elemento en el dropzone
        elementosDropzone.forEach(elemento => {
            // Buscar la clase que corresponde al nombre del dios o criatura
            const claseDios = Array.from(elemento.classList).find(cls =>
                diosesVerdaderos.includes(cls) || semiDioses.includes(cls) || criaturasMitologicas.includes(cls)
            );

            if (diosesVerdaderos.includes(claseDios)) {
                elemento.style.backgroundColor = "green"; // Color para dioses verdaderos
                console.log(`Elemento correcto: ${claseDios}`);
            } else if (semiDioses.includes(claseDios) || criaturasMitologicas.includes(claseDios)) {
                elemento.style.backgroundColor = "red"; // Color para elementos incorrectos
                console.log(`Elemento incorrecto: ${claseDios}`);
                todosCorrectos = false; // Si hay un elemento incorrecto, marcar la validación como fallida
            } else {
                console.log(`Elemento sin clase válida encontrada: ${elemento}`);
            }
        });

        // Verificar si todos los elementos son correctos
        if (todosCorrectos) {
            console.log("Todos los elementos son correctos. Redirigiendo...");
            // Redirigir a otra página si todos son correctos
            window.location.href = "pagina_correcta.html"; // Cambia "pagina_correcta.html" por la URL de la página a la que quieres redirigir
        } else {
            console.log("Error: Hay elementos incorrectos.");
            // Mostrar alerta de error si hay elementos incorrectos
            alert("Error: Hay elementos que no son dioses verdaderos. Revisa tu selección.");
        }
    }

    // Agregar evento de clic al botón para iniciar la validación
    const validateButton = document.getElementById("validateButton");
    if (validateButton) {
        validateButton.addEventListener("click", validarDioses);
    } else {
        console.error("El botón de validación no se encontró en el DOM.");
    }
});