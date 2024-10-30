function mostrarAlerta(icon, title, text, redirectUrl) {
  Swal.fire({
    icon: icon,
    title: title,
    text: text,
  }).then(() => {
    if (redirectUrl) {
      window.location.href = redirectUrl;
    }
  });
}
