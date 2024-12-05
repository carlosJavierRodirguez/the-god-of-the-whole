document
  .getElementById("btnIngresarSala")
  .addEventListener("click", async function () {
    const nombreJugador = document.getElementById("txtNombreJugador").value;
    const codigoSala = document.getElementById("txtCodigoSala").value;

    if (nombreJugador.length >= 2 && codigoSala.length === 5) {
      try {
        // Valida el acceso a la sala con una solicitud HTTP
        const response = await fetch(
          "../libreria/datosInvitado/Accesoinvitado.php",
          {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams({
              txtNombreJugador: nombreJugador,
              txtCodigoSala: codigoSala,
            }),
          }
        );

        if (!response.ok) {
          throw new Error(`Error HTTP: ${response.status}`);
        }

        const data = await response.json();

        if (data.status === "success") {
          // Conexión WebSocket para manejar la sala
          const socket = new WebSocket("ws://localhost:8080");

          socket.onopen = () => {
            console.log("Conexión WebSocket establecida");
            socket.send(
              JSON.stringify({
                tipo: "unirse_sala",
                codigoSala: codigoSala,
                nombreJugador: nombreJugador,
              })
            );
            console.log("Mensaje enviado al servidor WebSocket");
          };

          socket.onerror = (error) => {
            console.error("Error en la conexión WebSocket:", error);
          };

          socket.onclose = () => {
            console.log("Conexión WebSocket cerrada.");
          };

          // Redirige a la sala de espera después de validar y enviar los datos
          // window.location.href = "../sala/salaEsperaInvitado.php";
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: data.mensaje,
            confirmButtonText: "Aceptar",
          });
        }
      } catch (error) {
        Swal.fire({
          icon: "error",
          title: "Error de conexión",
          text: `Detalles: ${error.message}`,
          confirmButtonText: "Aceptar",
        });
      }
    } else {
      Swal.fire({
        icon: "error",
        title: "Campos inválidos",
        text: "Revisa el nombre y el código de la sala.",
        confirmButtonText: "Aceptar",
      });
    }
  });
