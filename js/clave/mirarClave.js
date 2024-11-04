const passwordInput = document.getElementById("txtClave");
const togglePassword = document.getElementById("togglePassword");
const icon = togglePassword.querySelector("i");

togglePassword.addEventListener("click", function () {
  // Alterna el tipo entre 'password' y 'text'
  const type =
    passwordInput.getAttribute("type") === "password" ? "text" : "password";
  passwordInput.setAttribute("type", type);

  // Cambia el icono según el estado
  icon.classList.toggle("fa-eye");
  icon.classList.toggle("fa-eye-slash");
});
