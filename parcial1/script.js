function confirmarTurno() {
    var mensaje = document.querySelector("#mensaje");
    mensaje.textContent = "Turno recibido - te atiende Jhonathan David Ramos Jimenez";
    mensaje.classList.remove("oculto");
}

var boton = document.querySelector("#btn-confirmar");
boton.addEventListener("click", confirmarTurno);