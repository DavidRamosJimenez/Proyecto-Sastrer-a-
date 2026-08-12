// Validación del formulario de Óptica Mirasol

const formulario = document.querySelector("#form-cita");
const aviso = document.querySelector("#aviso-cita");

function manejarEnvio(event) {
    const nombre = document.querySelector("#nombre").value;
    const correo = document.querySelector("#correo").value;

    if (nombre === "" || correo === "") {
        event.preventDefault();
        aviso.textContent = "Completa tu nombre y tu correo para reservar la cita.";
        aviso.classList.add("error");
        aviso.classList.remove("exito");
    } else if (!correo.includes("@")) {
        event.preventDefault();
        aviso.textContent = "Ese correo está mal escrito: le falta el arroba.";
        aviso.classList.add("error");
        aviso.classList.remove("exito");
    } else {
        // Todo bien: dejamos que el formulario salga hacia procesar.php
        aviso.textContent = "Cita reservada - te atiende Jhonathan David Ramos Jimenez";
        aviso.classList.add("exito");
        aviso.classList.remove("error");
    }
}

formulario.addEventListener("submit", manejarEnvio);