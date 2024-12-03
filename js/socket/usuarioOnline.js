fetch("../libreria/datosInvitado/imagenPerfilInvitado.php")
  .then((response) => response.json())
  .then((data) => {
    if (data.url_imagen && data.nombre_invitado && data.nombre_imagen) {
      const listaUsuarios = document.getElementById("lista-usuarios");

      const divUserProfile = document.createElement("div");
      divUserProfile.className = "user-profile form-group mt-2 rounded";

      const button = document.createElement("button");
      button.type = "button";
      button.className = "btn border-0 border seleccionPerfilImagen";

      const img = document.createElement("img");
      img.className = "user-icon";
      img.src = data.url_imagen;
      img.alt = data.nombre_imagen;

      const span = document.createElement("span");
      span.className = "username";
      span.textContent = data.nombre_invitado;

      button.appendChild(img);
      divUserProfile.appendChild(button);
      divUserProfile.appendChild(span);

      listaUsuarios.appendChild(divUserProfile);
    } else {
      console.error(data.error || "No se encontró la imagen.");
    }
  })
  .catch((error) => {
    console.error("Error en la solicitud:", error);
  });
