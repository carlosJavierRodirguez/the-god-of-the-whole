import mostrarAlerta from "../alertas/mostrarAlertas.js";

function copiarCodigo() {
  // Obtiene el texto del código
  const codigo = document.getElementById("codigo-sala").textContent;

  if (navigator.clipboard) {
    // API moderna del portapapeles
    navigator.clipboard
      .writeText(codigo)
      .then(() => {
        // Muestra una notificación de éxito
        mostrarAlerta("success", "Éxito", "Código copiado: " + codigo, "");
      })
      .catch((error) => {
        console.error("Error al copiar el código:", error);
        mostrarAlerta("error", "Error", "No se pudo copiar el código.", "");
      });
  } else {
    // Método de respaldo con `document.execCommand`
    const textarea = document.createElement("textarea");
    textarea.value = codigo;
    document.body.appendChild(textarea);
    textarea.select();

    try {
      document.execCommand("copy");
      mostrarAlerta("success", "Éxito", "Código copiado: " + codigo, "");
    } catch (error) {
      console.error("Error al copiar el código:", error);
      mostrarAlerta("error", "Error", "No se pudo copiar el código.", "");
    }

    // Elimina el elemento temporal
    document.body.removeChild(textarea);
  }
}

export { copiarCodigo };
