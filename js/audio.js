document.addEventListener('DOMContentLoaded', function() {
    const audioConfigModal = document.getElementById('audioConfigModal');
    const guardarConfigAudio = document.getElementById('guardarConfigAudio');
    const rangoMusica = document.getElementById('rangoMusica');
    const musicaIframe = document.getElementById('musicaIframe');

    // Cargar volumen almacenado
    const volumenMusica = localStorage.getItem('volumenMusica') || 5;
    rangoMusica.value = volumenMusica;

    // Escuchar eventos del modal para limpiar fondos
    audioConfigModal.addEventListener('hidden.bs.modal', function () {
        document.body.classList.remove('modal-open');
        const backdrops = document.getElementsByClassName('modal-backdrop');
        for (let backdrop of backdrops) {
            backdrop.remove();
        }
    });

    // Guardar configuración de audio
    guardarConfigAudio.addEventListener('click', function() {
        // Guardar volumen en localStorage
        localStorage.setItem('volumenMusica', rangoMusica.value);

        // Enviar mensaje al iframe de música para actualizar volumen
        if (musicaIframe && musicaIframe.contentWindow) {
            musicaIframe.contentWindow.postMessage({ 
                action: 'updateVolume', 
                volume: rangoMusica.value / 10 
            }, '*');
        }

        // Cerrar modal usando Bootstrap
        const modalInstance = bootstrap.Modal.getInstance(audioConfigModal);
        if (modalInstance) {
            modalInstance.hide();
        }
    });
});