// carga.js
document.addEventListener('DOMContentLoaded', function() {
    const loader = document.getElementById("loader");
    
    function mostrarLoader() {
        loader.classList.remove("loader2");
    }
    
    function ocultarLoader() {
        loader.classList.add("loader2");
    }

    // Ocultar loader inicialmente
    ocultarLoader();

    // Solo mostrar loader en navegación hacia adelante
    document.addEventListener('click', function(e) {
        const clickedLink = e.target.tagName === 'A' ? e.target : e.target.closest('a');
        if (clickedLink && !clickedLink.classList.contains('no-loader')) {
            mostrarLoader();
        }
    });

    // Para formularios
    document.querySelectorAll('form:not(.no-loader)').forEach(form => {
        form.addEventListener('submit', function() {
            mostrarLoader();
        });
    });

    // Asegurarse de que el loader esté oculto cuando:
    // 1. La página se carga inicialmente
    // 2. Se navega hacia atrás/adelante
    // 3. Se accede desde caché
    window.addEventListener('load', ocultarLoader);
    window.addEventListener('pageshow', function(event) {
        // También ocultar cuando se carga desde caché
        if (event.persisted) {
            ocultarLoader();
        }
    });
});


