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
            // Si la actualización fue exitosa, obtenemos la URL de la nueva imagen
            const nuevaUrlImagen = data.urlNuevaImagen;

            // Actualizamos la imagen de perfil visible en el DOM
            const imagenPerfilActual =
              document.getElementById("imagenPerfilActual"); // Asegúrate de que este ID es correcto
            if (imagenPerfilActual) {
              // Agregamos un parámetro único para evitar la caché
              imagenPerfilActual.src = `${nuevaUrlImagen}?_=${new Date().getTime()}`;
            }

            Swal.fire({
              icon: "success",
              title: "¡Éxito!",
              text: "Imagen de perfil actualizada con éxito.",
              confirmButtonText: "Aceptar",
            }).then(() => {
              // Cierra el modal si lo tienes
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
