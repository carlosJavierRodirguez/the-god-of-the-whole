// Define las funciones en el ámbito global
function mostrarAlertaExito() {
  Swal.fire({
    position: "center",
    icon: "success",
    title: "Usuario registrado exitosamente",
    showConfirmButton: false,
    timer: 1500,
  }).then(() => {
    window.location.href = " ../apartadoUsuario.php"; // lo redirige a la pagina si es exitoso el registro
  });
}

function mostrarAlertaError() {
  Swal.fire({
    position: "center",
    icon: "error",
    title: "Error al registrar usuario",
    text: "Please try again later.",
  }).then(() => {
    window.location.href = "iniciarSesion.php"; // lo redirige a la pagina si es exitoso el registro
  });
}

function AlertaExitoCodigo() {
  Swal.fire({
    position: "center",
    icon: "success",
    title: "Codigo Enviado Exitosamente",
    showConfirmButton: false,
    timer: 1500,
}).then(() => {
  window.location.href = "../codigoClave.php"; // lo redirige a la pagina si es exitoso el registro
});
}

function AlertaErrorCodigo() {
  Swal.fire({
    position: "center",
    icon: "error",
    title: "Error al enviar codigo",
    text: "Por favor intentar mas tarde.",
  }).then(() => {
    window.location.href = '../recuperarClave.php';// lo redirige a la pagina si es exitoso el registro
  });
}
