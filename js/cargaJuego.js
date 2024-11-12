document.addEventListener("DOMContentLoaded", () => {
    // Simular el tiempo de carga (3 segundos en este caso)
    setTimeout(() => {
        // Ocultar la pantalla de carga
        document.querySelector(".loading-screen").style.display = "none";

        // Mostrar el contenido principal
        document.querySelector(".content").style.display = "block";

        // Redirigir a otra página después de 3 segundos
        window.location.href = "juego.php"; // Cambia esto a la URL de la página a la que deseas redirigir
    }, 3000); // Tiempo de espera de 3 segundos (ajústalo según sea necesario)
});