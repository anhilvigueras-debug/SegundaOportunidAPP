// 1. Extraer datos del dataset e inyectarlos en el modal dinámico
function cargarDatosModal(evento) {
    const boton = evento.target.closest('.btn-modal-detalle');
    if (!boton) return;

    // Lectura de los atributos dataset del botón cliqueado
    const titulo = boton.dataset.titulo;
    const descripcion = boton.dataset.descripcion;
    const imagen = boton.dataset.imagen;
    const precio = boton.dataset.precio;
    const ubicacion = boton.dataset.ubicacion;
    const vendedor = boton.dataset.vendedor;
    const telefono = boton.dataset.telefono;
    const correo = boton.dataset.correo;

    const elTitulo = document.querySelector('#modalTitulo');
    const elDescripcion = document.querySelector('#modalDescripcion');
    const elImagen = document.querySelector('#modalImagen');
    const elPrecio = document.querySelector('#modalPrecio');
    const elUbicacion = document.querySelector('#modalUbicacion');
    const elVendedor = document.querySelector('#modalVendedor');

    if (elTitulo) elTitulo.textContent = titulo || 'Detalle del Producto';
    if (elDescripcion) elDescripcion.textContent = descripcion || '';
    if (elImagen) elImagen.src = imagen || '';
    if (elPrecio) elPrecio.textContent = precio || '';
    if (elUbicacion) elUbicacion.textContent = ubicacion || '';
    if (elVendedor) elVendedor.textContent = vendedor || '';

    // Actualización de enlaces de contacto 
    const elTelefono = document.querySelector('#modalTelefono');
    if (elTelefono) {
        elTelefono.textContent = telefono || '';
        elTelefono.href = `tel:${telefono ? telefono.replace(/\s+/g, '') : ''}`;
    }

    const elCorreo = document.querySelector('#modalCorreo');
    if (elCorreo) {
        elCorreo.textContent = correo || '';
        elCorreo.href = `mailto:${correo || ''}`;
    }

    // Instancia y apertura del modal dinámico de Bootstrap 
    const elModal = document.querySelector('#modalDinamico');
    if (elModal) {
        const modalBootstrap = bootstrap.Modal.getOrCreateInstance(elModal);
        modalBootstrap.show();
    }
}

//  Registrar eventos de clic 
function inicializarModalesDinamicos() {
    const botonesDetalle = document.querySelectorAll('.btn-modal-detalle');
    botonesDetalle.forEach(function (boton) {
        boton.addEventListener('click', cargarDatosModal);
    });
}

//  Inicialización tras la carga del DOM
document.addEventListener('DOMContentLoaded', inicializarModalesDinamicos);