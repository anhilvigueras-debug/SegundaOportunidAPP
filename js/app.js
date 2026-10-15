/**
 *  Toggle de Tema Claro/Oscuro (Dark/Light mode)
 *  Manejo de envío de formulario de contacto con notificación Toast
 */

document.addEventListener("DOMContentLoaded", function () {
    
    
    // 1. CAMBIO DE TEMA CLARO / OSCURO
 
    const elementoRaiz = document.querySelector('html');
    const botonTema = document.querySelector('#btn-tema');

    function alternarTema() {
        const temaActual = elementoRaiz.getAttribute('data-bs-theme') || 'light';
        
        if (temaActual === 'light') {
            elementoRaiz.setAttribute('data-bs-theme', 'dark');
            botonTema.textContent = ' Tema Claro';
        } else {
            elementoRaiz.setAttribute('data-bs-theme', 'light');
            botonTema.textContent = ' Cambiar Tema';
        }
    }

    if (botonTema) {
        botonTema.addEventListener('click', alternarTema);
    }

    //  MOSTRAR TOAST EN FORMULARIO DE CONTACTO
   
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

});