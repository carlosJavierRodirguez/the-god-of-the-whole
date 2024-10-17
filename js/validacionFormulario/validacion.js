(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        // Validaciones personalizadas
        const nombre = document.getElementById('txtNombreUsuario').value;
        const email = document.getElementById('txtEmailRegistro').value;
        const clave = document.getElementById('txtClaveRegistro').value;
        let valid = true;

        // Validar nombre de usuario
        if (nombre.length < 5) {
          alert("El nombre de usuario debe tener al menos 5 caracteres.");
          valid = false;
        }

        // Validar email
        if (!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
          alert("Por favor, ingrese un correo electrónico válido.");
          valid = false;
        }

        // Validar contraseña
        if (clave.length < 6) {
          alert("La contraseña debe tener al menos 6 caracteres.");
          valid = false;
        }

        // Si hay errores en la validación, previene el envío
        if (!valid) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          // Si todo es válido, envía el formulario
          form.classList.add('was-validated');
        }
      }, false);
    });
  })();