<<<<<<< HEAD
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
=======

const elementoRaiz = document.querySelector('html');
const botonTema = document.querySelector('#btn-tema');


function alternarTema() {
   
    const temaActual = elementoRaiz.getAttribute('data-bs-theme') || 'light';
    
  
    if (temaActual === 'light') {
        elementoRaiz.setAttribute('data-bs-theme', 'dark');
    } else {
        elementoRaiz.setAttribute('data-bs-theme', 'light');
    }
}


if (botonTema) {
    botonTema.addEventListener('click', alternarTema);
>>>>>>> main
}