(() => {
    'use strict';
  
    const forms = document.querySelectorAll('.needs-validation');
  
    Array.from(forms).forEach(form => {
      const submitButton = form.querySelector('button[type="submit"]');
      
      // Deshabilitar el botón de envío al principio
      submitButton.disabled = true;
  
      // Función para actualizar el estado del botón de envío
      const updateSubmitButtonState = () => {
        submitButton.disabled = !form.checkValidity();
      };
  
      // Actualizar el estado del botón cuando haya cambios en cualquier campo
      form.addEventListener('input', updateSubmitButtonState);
  
      form.addEventListener('submit', event => {
        // Prevenir el envío si hay campos inválidos
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
          form.classList.add('was-validated'); // Agregar clase solo si hay errores
        } else {
          form.classList.remove('was-validated'); // No hacer nada si todo es válido
        }
      }, false);
    });
  
    // Validación personalizada para el email
    const email = document.getElementById('txtEmail');
    email.addEventListener('input', () => {
      const emailRegex = /^\S+@\S+\.\S+$/;
      if (!emailRegex.test(email.value)) {
        email.setCustomValidity('Correo Electrónico Incorrecto');
        email.classList.add('is-invalid'); // Añadir clase para mostrar error
      } else {
        email.setCustomValidity('');
        email.classList.remove('is-invalid'); // Quitar clase si es válido
      }
    });
  
    // Validación personalizada para la contraseña
    const password = document.getElementById('txtClave');
    password.addEventListener('input', () => {
      if (password.value.length < 8) {
        password.setCustomValidity('Contraseña Incorrecta');
        password.classList.add('is-invalid'); // Añadir clase para mostrar error
      } else {
        password.setCustomValidity('');
        password.classList.remove('is-invalid'); // Quitar clase si es válido
      }
    });
  })();
  