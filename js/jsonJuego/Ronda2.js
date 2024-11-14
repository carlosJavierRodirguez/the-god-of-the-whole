// cargarJuego.js

document.addEventListener("DOMContentLoaded", function() {
    // Llama al archivo juego.php y obtén su contenido como texto
    fetch('juego.php')
        .then(response => response.text())
        .then(html => {
            // Creamos un contenedor temporal para manipular el HTML
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            // Modificamos la ronda y la pregunta
            const rondaTexto = doc.querySelector('.rondatexto');
            const preguntaTexto = doc.querySelector('.preguntatexto');

            if (rondaTexto && preguntaTexto) {
                rondaTexto.textContent = 'Ronda: 2'; // Cambia la ronda a 2
                preguntaTexto.textContent = '¿Qué dioses son semidioses?'; // Cambia la pregunta
            }

            // Mostramos el contenido modificado en el contenedor de otra página
            const contenedor = document.getElementById('contenedorJuego'); // Contenedor en la nueva página
            if (contenedor) {
                contenedor.innerHTML = doc.body.innerHTML;
            } else {
                console.error('No se encontró el contenedor en la página de destino.');
            }
        })
        .catch(error => {
            console.error('Error al cargar juego.php:', error);
        });
});