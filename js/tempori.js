const contador = document.getElementById("contador");
const loseModal = document.getElementById("loseModal");
const retryButton = document.getElementById("retryButton");
const readyButton = document.getElementById("validateButton");

let timeLeft = 20;
let timer;

// Función para iniciar el temporizador
function startTimer() {
    timer = setInterval(() => {
        timeLeft--;
        // Actualiza el contenido del contador
        contador.textContent = `Tiempo restante: ${timeLeft}s`;

        if (timeLeft <= 0) {
            clearInterval(timer);
            showModal();
        }
    }, 1000);
}

// Función para mostrar el modal de derrota
function showModal() {
    loseModal.style.display = "flex"; // Mostrar el modal
}

// Evento para recargar la página al hacer clic en "Seguir jugando"
retryButton.addEventListener("click", () => {
    location.reload(); // Recargar la página
});

// Evento al hacer clic en el botón "Listo"
readyButton.addEventListener("click", () => {
    clearInterval(timer);
    alert("¡Lo lograste a tiempo!");
    location.reload(); // Recarga para mostrar otra pregunta
});

// Inicia el temporizador al cargar la página
startTimer();
