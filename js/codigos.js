function nextInput(current) {
  const input = document.getElementById("input" + current);
  const nextInput = document.getElementById("input" + (current + 1));

  // Si el campo actual tiene un valor, pasa al siguiente
  if (input.value.length === 1 && nextInput) {
    nextInput.focus();
  }
}

// Permitir navegación con teclas de flechas izquierda/derecha
document.querySelectorAll(".codigo input").forEach((input, index) => {
  input.addEventListener("keydown", (e) => {
    if (e.key === "ArrowLeft" && index > 0) {
      document.getElementById("input" + index).focus();
    } else if (e.key === "ArrowRight" && index < 3) {
      document.getElementById("input" + (index + 2)).focus();
    }
  });
});
