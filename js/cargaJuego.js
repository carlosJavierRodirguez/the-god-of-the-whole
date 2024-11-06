document.addEventListener("DOMContentLoaded", () => {
    const loadingScreen = document.getElementById("loadingScreen");
    const progressBar = document.querySelector(".progress");

    // Simulación de carga
    setTimeout(() => {
        progressBar.style.width = "100%";
    }, 100);

    // Espera a que la animación de la barra termine
    setTimeout(() => {
        loadingScreen.classList.add("hidden"); // Oculta la pantalla de carga
        document.getElementById("mainContent").style.display = "block"; // Muestra el contenido principal
    }, 3100); // 3 segundos para la animación + 100ms de margen
});