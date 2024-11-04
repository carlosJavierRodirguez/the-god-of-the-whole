window.addEventListener("DOMContentLoaded", (event) => {
  // Obtener el elemento del toast
  const toastElement = document.getElementById("liveToast");
  // Crear una instancia de Bootstrap Toast
  const toast = new bootstrap.Toast(toastElement);
  // Mostrar el toast
  toast.show();
});
