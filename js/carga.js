document.addEventListener("DOMContentLoaded", function() {
    // Función para cargar el HTML de la pantalla de carga
    function cargarPantallaDeCarga() {
        fetch('./pantallaCarga.html') // Cargar el HTML de la pantalla de carga
            .then(response => response.text())
            .then(data => {
                // Insertar el HTML cargado en el body de la página actual
                document.body.insertAdjacentHTML('beforeend', data);
                let loadingScreen = document.getElementById("loadingScreen");
                let progressImage = document.getElementById("progressImage");

                // Añadir el evento a los enlaces que deben mostrar la pantalla de carga
                document.querySelectorAll('.buton').forEach(function(link) {
                    link.addEventListener('click', function(event) {
                        event.preventDefault(); // Evitar la redirección inmediata
                        let urlDestino = this.getAttribute('href'); // Obtener la URL destino del enlace

                        // Mostrar la pantalla de carga y simular el progreso
                        loadingScreen.style.display = 'flex';
                        let progress = 0;
                        let interval = setInterval(function() {
                            if (progress < 100) {
                                progress += 1;
                                progressImage.style.width = progress + '%'; // Llenar la barra
                            } else {
                                clearInterval(interval);
                                // Redirigir a la URL destino
                                window.location.href = urlDestino;
                            }
                        }, 30);  // Velocidad de carga (ajustable)
                    });
                });
            })
            .catch(error => console.error('Error cargando la pantalla de carga:', error));
    }

    cargarPantallaDeCarga(); // Cargar la pantalla de carga al cargar la página
});



