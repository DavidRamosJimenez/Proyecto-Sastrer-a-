console.log('✅ script.js cargado');

const themeToggle = document.getElementById('theme-toggle');
const body = document.body;

if (!themeToggle) {
    console.error('❌ No se encontró el botón con id="theme-toggle".');
}

function applyInitialTheme() {
    const savedTheme = localStorage.getItem('theme');

    if (savedTheme === 'dark') {
        body.classList.add('dark-mode');
        console.log('🌙 Tema oscuro restaurado');
    } else if (savedTheme === 'light') {
        body.classList.remove('dark-mode');
        console.log('☀️ Tema claro restaurado');
    } else {
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        body.classList.toggle('dark-mode', prefersDark);
        console.log(prefersDark ? '🌙 Sistema en oscuro' : '☀️ Sistema en claro');
    }
}

applyInitialTheme();

themeToggle.addEventListener('click', () => {
    body.classList.toggle('dark-mode');
    const isDark = body.classList.contains('dark-mode');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    console.log('Cambió a:', isDark ? 'oscuro' : 'claro');
});
