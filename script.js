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


// Validación del formulario de contacto

const formulario = document.querySelector("#form-contacto");
const aviso = document.querySelector("#aviso");

function manejarEnvio(event) {
    const nombre = document.querySelector("#nombre").value;
    const correo = document.querySelector("#correo").value;
    const mensaje = document.querySelector("#mensaje").value;

    if (nombre === "" || correo === "" || mensaje === "") {
        event.preventDefault();
        aviso.textContent = "Completa tu nombre, correo y mensaje para enviar la consulta.";
        aviso.classList.add("error");
        aviso.classList.remove("exito");
    } else if (!correo.includes("@")) {
        event.preventDefault();
        aviso.textContent = "Ese correo está mal escrito: le falta el arroba.";
        aviso.classList.add("error");
        aviso.classList.remove("exito");
    } else {
        aviso.textContent = "Mensaje enviado - te responde Jhonathan David Ramos Jimenez";
        aviso.classList.add("exito");
        aviso.classList.remove("error");
    }
}

formulario.addEventListener("submit", manejarEnvio);
