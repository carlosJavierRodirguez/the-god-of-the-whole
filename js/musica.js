const audio = document.getElementById('audio');

// Cargar el volumen y la posición almacenada al iniciar
const volumenMusica = localStorage.getItem('volumenMusica') || 5;
audio.volume = volumenMusica / 10;

const posicionMusica = localStorage.getItem('posicionMusica') || 0;
audio.currentTime = posicionMusica;  // Establecer la posición en la canción
audio.play();

// Guardar la posición actual cuando se detiene o pausa
window.addEventListener('beforeunload', () => {
    localStorage.setItem('posicionMusica', audio.currentTime);
});

// Escuchar los mensajes para actualizar el volumen
window.addEventListener('message', (event) => {
    if (event.data.action === 'updateVolume') {
        audio.volume = event.data.volume;
    }
});
