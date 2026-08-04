// Jhonathan David Ramos Jimenez

function confirmarCita() {
    var mensaje = document.querySelector("#mensaje");
    mensaje.textContent = "Cita recibida - te atiende Jhonathan David Ramos Jimenez";
    mensaje.classList.remove("oculto");
}

var boton = document.querySelector("#btn-confirmar");
boton.addEventListener("click", confirmarCita);
