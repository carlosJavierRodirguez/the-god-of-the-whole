document.addEventListener("DOMContentLoaded", () => {
    const diosesVerdaderos = ["afrodita", "apolo", "ares", "artemisa", "atenea", "hades", "hefesto", "hera", "poseidon", "zeus"];
    const semiDioses = ["gemini", "hercules"];
    const criaturasMitologicas = ["griffo", "minotauro", "sirenas"];

    const contador = document.getElementById("contador");
    const loseModal = document.getElementById("loseModal");
    const winModal = document.getElementById("winModal");
    const validateButton = document.getElementById("validateButton");
    const puntosElement = document.getElementById("puntos");

    const roundConfigs = [
        { time: 90, roundNumber: 1 },  // 1 minute 30 seconds
        { time: 60, roundNumber: 2 },  // 1 minute
        { time: 30, roundNumber: 3 }   // 30 seconds
    ];

    let currentRoundIndex = parseInt(localStorage.getItem('currentRoundIndex') || '0');
    let timeLeft;
    let timer;
    let totalPoints = 0;

    function contarElementosEnDropzone() {
        const elementosDropzone = document.querySelectorAll("#dropzone .draggable");
        return elementosDropzone.length;
    }

    function showLoseModal() {
        loseModal.style.display = "flex";
        setTimeout(() => {
            if (currentRoundIndex < roundConfigs.length - 1) {
                localStorage.setItem('currentRoundIndex', currentRoundIndex + 1);
                window.location.href = "pantallaCarga.php";
            } else {
                window.location.href = "pantallaCarga.php";
            }
        }, 2000);
    }

    function showWinModal(puntos) {
        winModal.style.display = "flex";
        puntosElement.textContent = puntos;
        setTimeout(() => {
            if (currentRoundIndex < roundConfigs.length - 1) {
                localStorage.setItem('currentRoundIndex', currentRoundIndex + 1);
                window.location.href = "pantallaCarga.php";
            } else {
                window.location.href = "pantallaCarga.php";
            }
        }, 2000);
    }

    function startNextRound() {
        // Ocultar modales
        loseModal.style.display = "none";
        winModal.style.display = "none";

        // Reset dropzone
        const dropzone = document.getElementById("dropzone");
        dropzone.innerHTML = '';

        // Reset drag container with new items
        const dragContainer = document.getElementById("drag-container");
        dragContainer.innerHTML = '';

        // Regenerate draggable items
        if (typeof generarDioses === 'function') {
            generarDioses();
        }

        // Reset timer
        timeLeft = roundConfigs[currentRoundIndex].time;
        contador.textContent = `Tiempo restante: ${timeLeft}s (Ronda ${roundConfigs[currentRoundIndex].roundNumber})`;

        startTimer();
    }

    function startTimer() {
        clearInterval(timer);
        timer = setInterval(() => {
            timeLeft--;
            contador.textContent = `Tiempo restante: ${timeLeft}s (Ronda ${roundConfigs[currentRoundIndex].roundNumber})`;

            if (timeLeft <= 0) {
                clearInterval(timer);
                showLoseModal();
            }
        }, 1000);
    }

    if (validateButton) {
        validateButton.addEventListener("click", (event) => {
            event.preventDefault();

            const cantidadElementos = contarElementosEnDropzone();

            if (cantidadElementos >= 4) {
                const puntos = cantidadElementos * 10;
                totalPoints += puntos;
                showWinModal(puntos);
            } else {
                alert("Error: Debes tener al menos 4 elementos en la zona de drop.");
            }
        });
    }

    // Start first/current round
    timeLeft = roundConfigs[currentRoundIndex].time;
    contador.textContent = `Tiempo restante: ${timeLeft}s (Ronda ${roundConfigs[currentRoundIndex].roundNumber})`;
    startTimer();
});