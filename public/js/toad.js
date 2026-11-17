/**
 * SegundaOportunidAPP - Notificaciones Toast (toad.js / toasts.js)
 * Responsable: Diego Cervantes Pérez
 * Descripción: Maneja el despliegue de mensajes flotantes (Toast) tras el envío 
 * exitoso de formularios (contacto, donaciones, reportes).
 */

document.addEventListener("DOMContentLoaded", function () {

    /**
     * Muestra la notificación Toast con el mensaje especificado
     * @param {string} mensaje - Texto a mostrar dentro de la alerta Toast
     */
    function mostrarToastContacto(mensaje) {
        const toastElemento = document.querySelector("#toastContacto");
        const mensajeElemento = document.querySelector("#mensajeToastContacto");

        if (!toastElemento || !mensajeElemento) return;

        mensajeElemento.textContent = mensaje;

        const toast = bootstrap.Toast.getOrCreateInstance(toastElemento);
        toast.show();
    }

    // Vinculación con el formulario de contacto
    const formularioContacto = document.querySelector("#formularioContacto");

    if (formularioContacto) {
        formularioContacto.addEventListener("submit", function (evento) {
            evento.preventDefault();

            // Verificación previa antes de mostrar el toast
            if (!formularioContacto.checkValidity()) {
                formularioContacto.reportValidity();
                return;
            }

            mostrarToastContacto("Tu mensaje se ha enviado correctamente.");
            formularioContacto.reset();
        });
    }

});