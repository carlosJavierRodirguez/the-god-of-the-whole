(() => {
  'use strict';

  const forms = document.querySelectorAll('.needs-validation');

  Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
          // Prevenir el envío si hay campos inválidos
          if (!form.checkValidity()) {
              event.preventDefault();
              event.stopPropagation();
              form.classList.add('was-validated'); // Agregar clase para mostrar validación
          } else {
              form.classList.remove('was-validated'); // Limpiar estado si todo es válido
          }
      }, false);
  });

  // Validación personalizada para el nombre de usuario
  const username = document.getElementById('txtNombreUsuario');
  username.addEventListener('input', () => {
      if (username.value.length < 5) {
          username.setCustomValidity('El nombre de usuario debe tener al menos 5 caracteres');
          username.classList.add('is-invalid');
      } else {
          username.setCustomValidity('');
          username.classList.remove('is-invalid');
      }
  });

  // Validación personalizada para el email
  const email = document.getElementById('txtEmailRegistro');
  email.addEventListener('input', () => {
      const emailRegex = /^\S+@\S+\.\S+$/;
      if (!emailRegex.test(email.value)) {
          email.setCustomValidity('Por favor, introduce un email válido');
          email.classList.add('is-invalid');
      } else {
          email.setCustomValidity('');
          email.classList.remove('is-invalid');
      }
  });

  // Validación personalizada para la contraseña
  const password = document.getElementById('txtClaveRegistro');
  password.addEventListener('input', () => {
      if (password.value.length < 8) {
          password.setCustomValidity('La contraseña debe tener al menos 8 caracteres');
          password.classList.add('is-invalid');
      } else {
          password.setCustomValidity('');
          password.classList.remove('is-invalid');
      }
  });

  // Opcional: Validación para confirmar contraseña
  const confirmPassword = document.getElementById('txtConfirmarClave');
  if (confirmPassword) {
      confirmPassword.addEventListener('input', () => {
          if (confirmPassword.value !== password.value) {
              confirmPassword.setCustomValidity('Las contraseñas no coinciden');
              confirmPassword.classList.add('is-invalid');
          } else {
              confirmPassword.setCustomValidity('');
              confirmPassword.classList.remove('is-invalid');
          }
      });
  }
})();