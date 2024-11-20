document
  .getElementById("btnIngresarSala")
  .addEventListener("click", function () {
    const nombreJugador = document.getElementById("txtNombreJugador").value;
    const codigoSala = document.getElementById("txtCodigoSala").value;

    if (nombreJugador.length >= 2 && codigoSala.length === 5) {
      // Enviar los datos al servidor PHP usando Fetch
      fetch("../ruta/a/tu/archivoPHP.php", {
        // Cambia esta ruta según tu estructura
        method: "POST",
        body: new URLSearchParams({
          txtNombreJugador: nombreJugador,
          txtCodigoSala: codigoSala,
        }),
      })
        .then((response) => response.json()) // Suponiendo que PHP devuelve JSON
        .then((data) => {
          if (data.status === "success") {
            // Redirige a la sala si la respuesta es exitosa
            window.location.href = "../sala/salaEsperaInvitado.php";
          } else {
            // Alerta de error
            Swal.fire({
              icon: "error",
              title: "Error al unirse a la sala",
              text: data.mensaje,
              confirmButtonText: "Aceptar",
            });
          }
        })
        .catch((error) => {
          // En caso de error en la petición
          Swal.fire({
            icon: "error",
            title: "Error de conexión",
            text: "Hubo un problema al procesar tu solicitud.",
            confirmButtonText: "Aceptar",
          });
          console.error("Error en la solicitud:", error);
        });
    } else {
      Swal.fire({
        icon: "error",
        title: "Campos Invalidos",
        text: "Por favor, asegúrate de que el nombre del jugador tenga al menos 2 caracteres y el código de la sala sea de 5 caracteres.",
        confirmButtonText: "Aceptar",
      });
    }
  });
