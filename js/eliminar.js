document.querySelectorAll('.username').forEach(username => {
    username.addEventListener('click', () => {
        const userProfile = username.parentElement; // Selecciona el div padre
        userProfile.remove(); // Elimina el div
    });
});