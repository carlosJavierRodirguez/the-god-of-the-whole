// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })

  // Custom validation for username
  const username = document.getElementById('txtNombreUsuario')
  username.addEventListener('input', () => {
    if (username.value.length < 5) {
      username.setCustomValidity('El nombre de usuario debe tener al menos 5 caracteres')
    } else {
      username.setCustomValidity('')
    }
  })

  // Custom validation for email
  const email = document.getElementById('txtEmailRegistro')
  email.addEventListener('input', () => {
    if (!/^\S+@\S+\.\S+$/.test(email.value)) {
      email.setCustomValidity('Por favor, introduce un email válido')
    } else {
      email.setCustomValidity('')
    }
  })

  // Custom validation for password
  const password = document.getElementById('txtClaveRegistro')
  password.addEventListener('input', () => {
    if (password.value.length < 8) {
      password.setCustomValidity('La contraseña debe tener al menos 8 caracteres')
    } else {
      password.setCustomValidity('')
    }
  })
})()