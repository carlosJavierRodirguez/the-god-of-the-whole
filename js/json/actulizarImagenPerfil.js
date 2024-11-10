document
  .querySelector("actilizarImagenPerfil")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Evita el envío del formulario de forma tradicional

    // Obtiene el valor seleccionado del formulario
    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());

    fetch("../libreria/datosUsuario/actualizarImagenPerfil.php", {
      method: "POST",
      body: JSON.stringify(data),
      headers: {
        "Content-Type": "application/json",
      },
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          alert(data.message);
          // Opcional: Actualiza la imagen de perfil en la página
          // document.getElementById('perfilImagen').src = 'nueva_ruta_de_la_imagen';
        } else {
          alert(data.message);
        }
      })
      .catch((error) => console.error("Error:", error));
  });
