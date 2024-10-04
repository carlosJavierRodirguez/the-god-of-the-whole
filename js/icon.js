// Selecciona todos los elementos de los iconos
const icons = document.querySelectorAll('.icon');

// Variable para almacenar el ícono seleccionado
let selectedIcon = null;

// Añade un event listener a cada ícono
icons.forEach(icon => {
    icon.addEventListener('click', () => {
        // Si ya hay un ícono seleccionado, quita la clase 'selected'
        if (selectedIcon) {
            selectedIcon.classList.remove('selected');
        }

        // Añade la clase 'selected' al ícono actual
        icon.classList.add('selected');

        // Actualiza el ícono seleccionado
        selectedIcon = icon;
    });
});
