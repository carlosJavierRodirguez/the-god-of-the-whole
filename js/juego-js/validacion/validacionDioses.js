document.addEventListener("DOMContentLoaded", () => {
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
    if (currentRoundIndex >= roundConfigs.length) {
        // Reiniciar el índice de la ronda si supera la cantidad de rondas
        currentRoundIndex = 0;
        localStorage.setItem('currentRoundIndex', currentRoundIndex);
    }

    let timeLeft;
    let timer;
    let totalPoints = 0;

    function contarElementosEnDropzone() {
        const elementosDropzone = document.querySelectorAll("#dropzone .draggable");
        return elementosDropzone.length;
    }

    function redirectToNextPage() {
        const loadingDiv = document.createElement('div');
        loadingDiv.innerHTML = `
            <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); 
                        display: flex; justify-content: center; align-items: center; z-index: 1000; color: white; font-size: 24px;">
                Cargando siguiente nivel...
            </div>
        `;
        document.body.appendChild(loadingDiv);

        setTimeout(() => {
            document.body.removeChild(loadingDiv);

            if (currentRoundIndex >= roundConfigs.length) {
                window.location.href = 'ranking.php';
            } else {
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

            if (currentRoundIndex < roundConfigs.length) {
                redirectToNextPage();
            } else {
                window.location.href = 'ranking.php';
            }
        }, 2000);
    }

    function showWinModal(puntos) {
        winModal.style.display = "flex";
        clearInterval(timer);
        puntosElement.textContent = puntos;
        setTimeout(() => {
            currentRoundIndex++;
            localStorage.setItem('currentRoundIndex', currentRoundIndex);

            if (currentRoundIndex < roundConfigs.length) {
                redirectToNextPage();
            } else {
                window.location.href = 'ranking.php';
            }
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

            const cantidadElementos = contarElementosEnDropzone();

            if (cantidadElementos >= 4) {
                const puntos = cantidadElementos * 10;
                totalPoints += puntos;
                showWinModal(puntos);
            } else {
                Swal.fire({
                    title: '¿Parece que algo te detiene?',
                    text: '¡Debes tener al menos 4 entidades en el conjunto!',
                    imageUrl: '../img/Zeus-Trono.webp',
                    imageWidth: 500,
                    imageHeight: 500,
                    imageAlt: 'Error de validación',
                    showConfirmButton: false,
                    background: 'rgba(0, 0, 0, 0.8)',
                    customClass: {
                        popup: 'custom-swal-popup',
                        title: 'custom-swal-title',
                        htmlContainer: 'custom-swal-text',
                    },
                    didRender: () => {
                        const swalContent = Swal.getHtmlContainer();

                        const buttonContainer = document.createElement('div');
                        buttonContainer.style.position = 'relative';
                        buttonContainer.style.display = 'inline-block';
                        buttonContainer.style.cursor = 'pointer';
                        buttonContainer.style.width = '230px';
                        buttonContainer.style.marginTop = '10px';

                        const buttonImage = document.createElement('img');
                        buttonImage.src = '../img/img-validaciones/boton-modal.png';
                        buttonImage.alt = 'Volver';
                        buttonImage.style.width = '100%';
                        buttonImage.style.height = '100%';
                        buttonImage.style.objectFit = 'cover';

                        const buttonText = document.createElement('span');
                        buttonText.textContent = 'Volver';
                        buttonText.style.position = 'absolute';
                        buttonText.style.top = '45%';
                        buttonText.style.left = '50%';
                        buttonText.style.transform = 'translate(-50%, -50%)';
                        buttonText.style.color = '#fff';
                        buttonText.style.fontSize = '20px';
                        buttonText.style.fontWeight = 'bold';
                        buttonText.style.textAlign = 'center';
                        buttonText.style.textShadow = '0 0 5px #000';

                        buttonContainer.addEventListener('click', () => {
                            Swal.close();
                            if (timeLeft > 0) startTimer();
                        });

                        buttonContainer.appendChild(buttonImage);
                        buttonContainer.appendChild(buttonText);

                        swalContent.appendChild(buttonContainer);
                    },
                });
            }
        });
    }

    timeLeft = roundConfigs[currentRoundIndex].time;
    contador.textContent = `Tiempo restante: ${timeLeft}s (Ronda ${roundConfigs[currentRoundIndex].roundNumber})`;
    startTimer();
});