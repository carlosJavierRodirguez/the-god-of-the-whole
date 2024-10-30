(() => {
  'use strict';

  const forms = document.querySelectorAll('.needs-validation');

  Array.from(forms).forEach(form => {
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
      if (!/^\S+@\S+\.\S+$/.test(email.value)) {
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
