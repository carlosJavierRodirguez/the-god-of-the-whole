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
    const username = document.getElementById('txtNombreJugador')
    username.addEventListener('input', () => {
      if (username.value.length < 3) {
        username.setCustomValidity('El nombre de usuario debe tener al menos 3 caracteres')
      } else {
        username.setCustomValidity('')
      }
    })
  
  
    // Custom validation for password
    const codigo = document.getElementById('txtCodigoSala')
    codigo.addEventListener('input', () => {
      if (codigo.value.length < 5) {
        codigo.setCustomValidity('El codigo debe tenr al menos 5 numeros')
      } else {
        codigo.setCustomValidity('')
      }
    })
  })()