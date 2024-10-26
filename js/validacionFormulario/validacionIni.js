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
  
    // Custom validation for email
    const email = document.getElementById('txtEmail')
    email.addEventListener('input', () => {
      if (!/^\S+@\S+\.\S+$/.test(email.value)) {
        email.setCustomValidity('Correo Electronico Incorrecto')
      } else {
        email.setCustomValidity('')
      }
    })
  
    // Custom validation for password
    const password = document.getElementById('txtClave')
    password.addEventListener('input', () => {
      if (password.value.length < 8) {
        password.setCustomValidity('Contraseña Incorrecta')
      } else {
        password.setCustomValidity('')
      }
    })
  })()