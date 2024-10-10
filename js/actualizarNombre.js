document
  .getElementById("formActualizarNombre")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Evita el envío normal del formulario

    const nuevoNombre = document.getElementById("nuevoNombre").value;

    // Realizar la llamada AJAX
    fetch("libreria/acceso.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams({
        accion: "actualizarNombre",
        nuevoNombre: nuevoNombre,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          // Actualización exitosa
          Swal.fire({
            icon: "success",
            title: "¡Éxito!",
            text: "Nombre actualizado con éxito.",
            confirmButtonText: "Aceptar",
          }).then(() => {
            // Actualiza el nombre en el DOM para reflejar el cambio inmediatamente
            document.getElementById("nombreUsuarioDisplay").innerText =
              nuevoNombre;
            // Cerrar el modal
            $("#actualizarNombreModal").modal("hide");
          });
        } else {
          // Manejar error
          alert(data.message || "Ocurrió un error al actualizar el nombre.");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });
