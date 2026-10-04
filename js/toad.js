function mostrarToastContacto(mensaje) {
    const toastElemento = document.querySelector("#toastContacto");
    const mensajeElemento = document.querySelector("#mensajeToastContacto");

    if (!toastElemento || !mensajeElemento) return;

    mensajeElemento.textContent = mensaje;

    const toast = bootstrap.Toast.getOrCreateInstance(toastElemento);
    toast.show();
}

const formularioContacto = document.querySelector("#formularioContacto");

if (formularioContacto) {
    formularioContacto.addEventListener("submit", function (evento) {
        evento.preventDefault();

        if (!formularioContacto.checkValidity()) {
            formularioContacto.reportValidity();
            return;
        }

        mostrarToastContacto("Tu mensaje se ha enviado correctamente.");
        formularioContacto.reset();
    });
}