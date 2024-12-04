const getBasePath = () => {
    const path = window.location.pathname;
    const projectRoot = path.substring(0, path.indexOf('/', 1) + 1);
    return projectRoot || '/';
};

document.addEventListener('DOMContentLoaded', function() {
    const basePath = getBasePath();
    let currentLang = localStorage.getItem('language') || 'es';
    
    const languageSelector = document.createElement('div');
    languageSelector.className = 'language-selector';
    languageSelector.innerHTML = `
        <select id="langSelect">
            <option value="es">Español</option>
            <option value="en">English</option>
        </select>
    `;
    document.body.insertBefore(languageSelector, document.body.firstChild);
    document.getElementById('langSelect').value = currentLang;

    const translations = {
        "es": {
            // Menú principal
            "jugar": "Jugar Online",
            "configuraciones": "Configuraciones",
            "cargando": "Cargando",
            "musica": "Música",
            "guardar": "Guardar",
            "unirse": "Unirse",
            "crear": "Crear Sala",
            "nombre": "Nombre del Jugador",
            "pin": "Pin del Juego",
            "ingresar": "Ingresar",
            "propia": "Crea tu propia sala",
            "iniciarSe": "Iniciar Sesión",
            "email": "Email",
            "correo": "correo@gmail.com",
            "contra": "Contraseña", 
            "olvidar": "¿Olvidaste tu contraseña?",
            "cuenta": "¿No tienes cuenta?",
            "min": "Se esperaba un @",
            "minP": "Contraseña mínimo 8 caracteres",
            "tener": "¿Ya tienes cuenta?",
            "name": "Nombre",
            "user": "Usuario15000",
            "registrar": "Registrarse",
            "enviar": "Enviar"

        },
        "en": {
            // Main menu
            "jugar": "Play Online",
            "configuraciones": "Settings",
            "cargando": "Loading...",
            "musica": "Music",
            "guardar": "Save",
            "unirse": "Join",
            "crear": "Create Room",
            "nombre": "Player Name",
            "pin": "Game Pin",
            "ingresar": "Get into",
            "propia": "Create your own room",
            "iniciarSe": "Login",
            "email": "E-mail",
            "correo": "email@gmail.com",
            "contra": "Password",
            "olvidar": "Forgot your password?",
            "cuenta": "Don't have an account?",
            "min": "An @ was expected",
            "minp": "Password minimum 8 characters",
            "tener": "Already have an account?",
            "name": "Name",
            "user": "User15000",
            "registrar": "Register",
            "Enviar": "Send"
           

        }
    };

    function updateContent(lang) {
        document.querySelectorAll('[data-i18n]').forEach(element => {
            const key = element.getAttribute('data-i18n');
            if (translations[lang] && translations[lang][key]) {
                element.innerHTML = translations[lang][key];
            }
        });

        document.querySelectorAll('[data-i18n-placeholder]').forEach(element => {
            const key = element.getAttribute('data-i18n-placeholder');
            if (translations[lang] && translations[lang][key]) {
                element.placeholder = translations[lang][key];
            }
        });

        document.dispatchEvent(new CustomEvent('languageChanged', { detail: { language: lang } }));
        localStorage.setItem('language', lang);
        document.documentElement.lang = lang;
    }

    document.getElementById('langSelect').addEventListener('change', function(e) {
        currentLang = e.target.value;
        updateContent(currentLang);
    });

    updateContent(currentLang);
});