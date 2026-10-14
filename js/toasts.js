
document.addEventListener("DOMContentLoaded", function () {

    // BUSQUEDA DEL CATALOGO DE INICIO
    const buscarArticulo = document.getElementById("buscarArticulo");

    if (buscarArticulo) {
        const articulos = document.querySelectorAll(
            '[aria-label="Catálogo de artículos"] .row.row-cols-1 > .col'
        );

        buscarArticulo.addEventListener("input", function () {
            const texto = buscarArticulo.value.toLowerCase().trim();

            articulos.forEach(function (articulo) {
                const contenido = articulo.textContent.toLowerCase();

                if (contenido.includes(texto)) {
                    articulo.style.display = "";
                } else {
                    articulo.style.display = "none";
                }
            });
        });
    }

    // BUSQUEDA DE CONVERSACIONES
    const campoMensajes = document.getElementById("campoBusqueda");

    if (campoMensajes) {
        const lista = document.querySelector(".list-group");

        if (lista) {
            const conversaciones = lista.querySelectorAll(".list-group-item");

            campoMensajes.addEventListener("input", function () {
                const texto = campoMensajes.value.toLowerCase().trim();

                conversaciones.forEach(function (conversacion) {
                    const contenido = conversacion.textContent.toLowerCase();

                    if (contenido.includes(texto)) {
                        conversacion.style.display = "";
                    } else {
                        conversacion.style.display = "none";
                    }
                });
            });
        }
    }

    // BUSQUEDA DE SERVICIOS
    const buscarServicio = document.querySelector(
        'main input#campoBusqueda'
    );

    if (buscarServicio && !document.getElementById("buscarArticulo")) {
        const servicios = document.querySelectorAll(
            ".row.row-cols-1.row-cols-md-3 > .col"
        );

        buscarServicio.addEventListener("input", function () {
            const texto = buscarServicio.value.toLowerCase().trim();

            servicios.forEach(function (servicio) {
                const contenido = servicio.textContent.toLowerCase();

                if (contenido.includes(texto)) {
                    servicio.style.display = "";
                } else {
                    servicio.style.display = "none";
                }
            });
        });
    }

});
