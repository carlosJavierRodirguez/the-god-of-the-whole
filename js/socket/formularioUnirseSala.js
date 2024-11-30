document
  .getElementById("btnIngresarSala")
  .addEventListener("click", function () {
    const nombreJugador = document.getElementById("txtNombreJugador").value;
    const codigoSala = document.getElementById("txtCodigoSala").value;

    if (nombreJugador.length >= 2 && codigoSala.length === 5) {
      fetch("../libreria/datosInvitado/Accesoinvitado.php", {
        method: "POST",
        body: new URLSearchParams({
          txtNombreJugador: nombreJugador,
          txtCodigoSala: codigoSala,
        }),
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error(`Error HTTP: ${response.status}`);
          }
          return response.json();
        })
        .then((data) => {
          if (data.status === "success") {
            window.location.href = "../sala/salaEsperaInvitado.php";
          } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: data.mensaje,
              confirmButtonText: "Aceptar",
            });
          }
        })
        .catch((error) => {
          Swal.fire({
            icon: "error",
            title: "Error de conexión",
            text: `Detalles: ${error.message}`,
            confirmButtonText: "Aceptar",
          });
        });
    } else {
      Swal.fire({
        icon: "error",
        title: "Campos inválidos",
        text: "Revisa el nombre y el código de la sala.",
        confirmButtonText: "Aceptar",
      });
    }
  });
