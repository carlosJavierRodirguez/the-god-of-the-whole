// Define las funciones en el ámbito global
function mostrarAlertaExito() {
  Swal.fire({
    position: "center",
    icon: "success",
    title: "Usuario registrado exitosamente",
    showConfirmButton: false,
    timer: 1500,
  }).then(() => {
    window.location.href = "../inicioUsuario.php"; // lo redirige a la pagina si es exitoso el registro
  });
}

function mostrarAlertaError() {
  Swal.fire({
    position: "center",
    icon: "error",
    title: "Error al registrar usuario",
    text: "Please try again later.",
  });
}
