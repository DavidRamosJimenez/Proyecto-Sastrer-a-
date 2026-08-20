/**
 * Sastrería Jiménez - Script principal
 * Archivo: public/js/sastreria.js
 * Controla el tema claro/oscuro
 */

console.log('Sastrería Jiménez - script cargado');

const themeToggle = document.getElementById('theme-toggle');
const body = document.body;

if (themeToggle) {
    // Aplica el tema guardado o detecta el del sistema
    function applyInitialTheme() {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            body.classList.add('dark-mode');
        } else if (savedTheme === 'light') {
            body.classList.remove('dark-mode');
        } else {
            // Primera visita: usa la preferencia del sistema
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            body.classList.toggle('dark-mode', prefersDark);
        }
    }

    applyInitialTheme();

    // Alterna entre tema claro y oscuro al hacer clic
    themeToggle.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        const isDark = body.classList.contains('dark-mode');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    });
}
