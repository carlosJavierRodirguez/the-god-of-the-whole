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
        { time: 90, roundNumber: 1 },
        { time: 60, roundNumber: 2 },
        { time: 30, roundNumber: 3 }
    ];

    let currentRoundIndex = parseInt(localStorage.getItem('currentRoundIndex') || '0');
    let timeLeft;
    let timer;
    let totalPoints = 0;

    function contarElementosEnDropzone() {
        const elementosDropzone = document.querySelectorAll("#dropzone .draggable");
        return elementosDropzone.length;
    }

    function redirectToNextPage() {
        // Crear un elemento de carga temporal
        const loadingDiv = document.createElement('div');
        loadingDiv.innerHTML = `
            <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); 
                        display: flex; justify-content: center; align-items: center; z-index: 1000; color: white; font-size: 24px;">
                Cargando siguiente nivel...
            </div>
        `;
        document.body.appendChild(loadingDiv);

        // Simular tiempo de carga
        setTimeout(() => {
            // Eliminar div de carga
            document.body.removeChild(loadingDiv);

            // Verificar si es la última ronda
            if (currentRoundIndex >= roundConfigs.length - 1) {
                // Redirigir a ranking
                window.location.href = 'ranking.php';
            } else {
                // Ir a siguiente ronda
                window.location.href = 'juego.php';
            }
        }, 2000);
    }

    function showLoseModal() {
        loseModal.style.display = "flex";
        clearInterval(timer);
        setTimeout(() => {
            currentRoundIndex++;
            localStorage.setItem('currentRoundIndex', currentRoundIndex);
            redirectToNextPage();
        }, 2000);
    }

    function showWinModal(puntos) {
        winModal.style.display = "flex";
        clearInterval(timer);
        puntosElement.textContent = puntos;
        setTimeout(() => {
            currentRoundIndex++;
            localStorage.setItem('currentRoundIndex', currentRoundIndex);
            redirectToNextPage();
        }, 2000);
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
            clearInterval(timer);

            const cantidadElementos = contarElementosEnDropzone();

            if (cantidadElementos >= 4) {
                const puntos = cantidadElementos * 10;
                totalPoints += puntos;
                showWinModal(puntos);
            } else {
                alert("Error: Debes tener al menos 4 elementos en la zona de drop.");
                startTimer();
            }
        });
    }

    // Iniciar primera ronda
    timeLeft = roundConfigs[currentRoundIndex].time;
    contador.textContent = `Tiempo restante: ${timeLeft}s (Ronda ${roundConfigs[currentRoundIndex].roundNumber})`;
    startTimer();
});