document.addEventListener("DOMContentLoaded", function () {
  const formulario = document.getElementById("formActualizarImagenPerfil");

  if (formulario) {
    formulario.addEventListener("submit", function (event) {
      event.preventDefault(); // Evita el envío tradicional del formulario

      const formData = new FormData(this); // Captura los datos del formulario

      // Realiza la llamada AJAX para actualizar la imagen
      fetch("../libreria/datosUsuario/actualizarImagenPerfil.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {

          if (data.success) {
            Swal.fire({
              icon: "success",
              title: "¡Éxito!",
              text: "Imagen de perfil actualizada con éxito.",
              confirmButtonText: "Aceptar",
            }).then(() => {
              location.reload();
              // Cierra el modal
              $("#actulizarImagenPerfilModal").modal("hide");
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text:
                data.message ||
                "Hubo un problema al actualizar la imagen de perfil.",
              confirmButtonText: "Aceptar",
            });
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          Swal.fire({
            icon: "error",
            title: "Error de red",
            text: "Hubo un problema al conectar con el servidor.",
            confirmButtonText: "Aceptar",
          });
        });
    });
  }
});
