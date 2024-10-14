document.addEventListener('DOMContentLoaded', function() {
  const pathname = document.location.pathname;

  // Configuración general de música para todas las páginas
  const musicaIframe = document.getElementById('musicaIframe');

  if (musicaIframe && musicaIframe.contentWindow) {
      const musicaIframeWindow = musicaIframe.contentWindow;
      
      // Obtener volumen almacenado y reproducir música
      const volumenMusica = localStorage.getItem('volumenMusica') || 5;
      musicaIframeWindow.postMessage({ action: 'playMusic', volume: volumenMusica / 10 }, '*');

      // Ajustes específicos de la página de configuraciones
      if (pathname.includes('configuraciones.php')) {
          const rangoMusica = document.getElementById('rangoMusica');
          const botonGuardar = document.getElementById('botonGuardar');
          
          // Cargar volumen actual en el control deslizante
          rangoMusica.value = volumenMusica;

          // Guardar el volumen actualizado al hacer clic en "Guardar"
          botonGuardar.addEventListener('click', function(event) {
              event.preventDefault();
              localStorage.setItem('volumenMusica', rangoMusica.value);
              musicaIframeWindow.postMessage({ action: 'updateVolume', volume: rangoMusica.value / 10 }, '*');
              window.location.href = "index.php";
          });
      }
  } else {
      console.error('El iframe de música no está disponible.');
  }
});

  