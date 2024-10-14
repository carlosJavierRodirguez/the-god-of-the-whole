const audio = document.getElementById('audio');

// Cargar volumen almacenado al iniciar
const volumenMusica = localStorage.getItem('volumenMusica') || 5;
audio.volume = volumenMusica / 10;

// Escuchar los mensajes para actualizar el volumen
window.addEventListener('message', (event) => {
    if (event.data.action === 'updateVolume') {
        audio.volume = event.data.volume;
    }
});
