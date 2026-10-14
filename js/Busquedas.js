
function filtrarElementos(campoId, elementosClase) {
    let campoBusqueda = document.getElementById(campoId);

    if (!campoBusqueda) {
        return;
    }

    let busqueda = campoBusqueda.value.toLowerCase();
    let elementos = document.querySelectorAll(elementosClase);

    elementos.forEach(function(elemento) {
        let texto = elemento.textContent.toLowerCase();

        elemento.classList.toggle("d-none", !texto.includes(busqueda));
    });
}

function buscarArticulos() {
    filtrarElementos("busquedaArticulos", ".catalogo-item");
}

function buscarServicios() {
    filtrarElementos("busquedaServicios", ".servicio-item");
}

function buscarMensajes() {
    filtrarElementos("busquedaMensajes", ".mensaje-item");
}

let busquedaArticulos = document.getElementById("busquedaArticulos");
let busquedaServicios = document.getElementById("busquedaServicios");
let busquedaMensajes = document.getElementById("busquedaMensajes");

if (busquedaArticulos) {
    busquedaArticulos.addEventListener("input", buscarArticulos);
    busquedaArticulos.addEventListener("keyup", buscarArticulos);
}

if (busquedaServicios) {
    busquedaServicios.addEventListener("input", buscarServicios);
    busquedaServicios.addEventListener("keyup", buscarServicios);
}

if (busquedaMensajes) {
    busquedaMensajes.addEventListener("input", buscarMensajes);
    busquedaMensajes.addEventListener("keyup", buscarMensajes);
}
