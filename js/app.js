
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
}