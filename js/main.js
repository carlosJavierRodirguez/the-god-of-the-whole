// manejo del boton de copiar el codigo
const btnCopy = document.querySelector(".btn-copy");

if (btnCopy) {
  import("./juego-js/copiarCodigo.js")
    .then(({ copiarCodigo }) => {
      btnCopy.addEventListener("click", copiarCodigo);
    })
    .catch((error) =>
      console.error("Error al cargar el módulo copiarCodigo:", error)
    );
} else {
  //   console.warn("El botón con la clase '.btn-copy' no está presente en el DOM.");
}

// Manejo del botón para abrir el modal del chat
const btnPrimary = document.querySelector(".btn-primary");

if (btnPrimary) {
  // Intento de carga dinámica del módulo
  import("./juego-js/modalChat.js")
    .then(({ openChatModal }) => {
      btnPrimary.addEventListener("click", openChatModal);
    })
    .catch((error) =>
      console.error("Error al cargar el módulo modalChat:", error)
    );
} else {
  //   console.warn(
  //      "El botón con la clase '.btn-primary' no está presente en el DOM."
  //   );
}
