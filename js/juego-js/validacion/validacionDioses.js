document.addEventListener("DOMContentLoaded", () => {
    const diosesVerdaderos = ["afrodita", "apolo", "ares", "artemisa", "atenea", "hades", "hefesto", "hera", "poseidon", "zeus"];
    const semiDioses = ["gemini", "hercules"];
    const criaturasMitologicas = ["griffo", "minotauro", "sirenas"];

    const contador = document.getElementById("contador");
    const loseModal = document.getElementById("loseModal");
    const winModal = document.getElementById("winModal"); // Modal de felicitaciones
    const validateButton = document.getElementById("validateButton");
    const puntosElement = document.getElementById("puntos"); // Para mostrar los puntos en el modal

    let timeLeft = 20;
    let timer;

    // Función para validar los elementos en la zona de drop
    function contarElementosEnDropzone() {
        const elementosDropzone = document.querySelectorAll("#dropzone .draggable");
        return elementosDropzone.length; // Devuelve la cantidad de elementos en la zona de drop
    }

    // Mostrar el modal de pérdida y redirigir después de 2 segundos
    function showLoseModal() {
        loseModal.style.display = "flex";
        setTimeout(() => {
            window.location.href = "pantallaCarga.php"; // Redirigir a la pantalla de carga
        }, 2000);
    }

    // Mostrar el modal de felicitaciones y redirigir a pantalla de carga
    function showWinModal(puntos) {
        winModal.style.display = "flex";
        puntosElement.textContent = puntos; // Mostrar los puntos
        setTimeout(() => {
            window.location.href = "pantallaCarga.php"; // Redirigir a la pantalla de carga
        }, 2000);
    }

    // Función para iniciar el temporizador
    function startTimer() {
        timer = setInterval(() => {
            timeLeft--;
            contador.textContent = `Tiempo restante: ${timeLeft}s`;

            if (timeLeft <= 0) {
                clearInterval(timer);
                showLoseModal(); // Mostrar el modal de pérdida y redirigir
            }
        }, 1000);
    }

    // Evento al hacer clic en el botón "Listo"
    if (validateButton) {
        validateButton.addEventListener("click", (event) => {
            event.preventDefault();

            const cantidadElementos = contarElementosEnDropzone();

            if (cantidadElementos >= 4) {
                const puntos = cantidadElementos * 10; // Ejemplo: cada elemento da 10 puntos
                showWinModal(puntos); // Mostrar modal de felicitaciones con puntos
            } else {
                alert("Error: Debes tener al menos 4 elementos en la zona de drop.");
            }
        });
    }

    // Iniciar el temporizador al cargar la página
    startTimer();
});
