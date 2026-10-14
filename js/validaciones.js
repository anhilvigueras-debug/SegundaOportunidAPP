<<<<<<< HEAD
document.addEventListener("DOMContentLoaded", function () {
const formularios = document.querySelectorAll(".form-validado");

formularios.forEach(function (formulario) {
    const alerta = formulario.querySelector(".alerta-validacion");
    const mensajeAlerta = formulario.querySelector(".mensaje-alerta");
    const listaCampos = formulario.querySelector(".lista-campos");
    const campos = formulario.querySelectorAll("input[required], textarea[required], select[required]");

    formulario.addEventListener("submit", function (evento) {
        evento.preventDefault();

        const camposInvalidos = [];

        campos.forEach(function (campo) {
            if (!campo.checkValidity()) {
                campo.classList.add("is-invalid");
                campo.classList.remove("is-valid");

                const nombreCampo =
                    campo.dataset.nombre || campo.name || campo.id || "Campo sin nombre";

                camposInvalidos.push(nombreCampo);
            } else {
                campo.classList.remove("is-invalid");
                campo.classList.add("is-valid");
            }
        });

        if (alerta && mensajeAlerta && listaCampos) {
            listaCampos.innerHTML = "";

            if (camposInvalidos.length > 0) {
                mensajeAlerta.textContent =
                    "Completa correctamente los siguientes campos:";

                camposInvalidos.forEach(function (nombre) {
                    const elemento = document.createElement("li");
                    elemento.textContent = nombre;
                    listaCampos.appendChild(elemento);
                });

                alerta.classList.remove("d-none", "alert-success");
                alerta.classList.add("alert-danger");
            } else {
                mensajeAlerta.textContent =
                    "¡Todos los campos se han validado correctamente!";

                alerta.classList.remove("d-none", "alert-danger");
                alerta.classList.add("alert-success");
            }

            alerta.scrollIntoView({
                behavior: "smooth",
                block: "center"
            });
        }
    });

    campos.forEach(function (campo) {
        campo.addEventListener("input", function () {
            if (campo.checkValidity()) {
                campo.classList.remove("is-invalid");
                campo.classList.add("is-valid");
            } else {
                campo.classList.add("is-invalid");
                campo.classList.remove("is-valid");
            }
        });

        campo.addEventListener("change", function () {
            if (campo.checkValidity()) {
                campo.classList.remove("is-invalid");
                campo.classList.add("is-valid");
            } else {
                campo.classList.add("is-invalid");
                campo.classList.remove("is-valid");
            }
        });
    });
});

});
=======

"use strict";

/*
 SegundaOportunidAPP
 Validación de formularios en tiempo real
 
Formularios:
 - contacto.html
 - login.html
 - reporte.html

 Se utiliza getElementById() porque los formularios
 y las alertas tienen identificadores únicos.
 Esto permite acceder directamente a cada elemento
 sin depender de selectores CSS.

 Se utiliza addEventListener() con funciones con nombre.
 No se utiliza onclick ni onsubmit en HTML.
 */

document.addEventListener(
    "DOMContentLoaded",
    iniciarValidaciones
);

/* INICIAR VALIDACIONES */

function iniciarValidaciones() {

    const formularios = [
        "formularioContacto",
        "formularioLogin",
        "formReporte"
    ];

    formularios.forEach(configurarFormulario);
}

/* CONFIGURAR FORMULARIO */

function configurarFormulario(idFormulario) {

    const formulario = document.getElementById(idFormulario);

    if (formulario === null) {
        return;
    }

    const campos = obtenerCampos(formulario);

    campos.forEach(configurarCampo);

    formulario.addEventListener(
        "submit",
        validarFormulario
    );
}

/* OBTENER CAMPOS */

function obtenerCampos(formulario) {

    return Array.from(formulario.elements).filter(
        esCampoValidable
    );
}

function esCampoValidable(campo) {

    const etiquetas = [
        "INPUT",
        "TEXTAREA",
        "SELECT"
    ];

    const tiposExcluidos = [
        "hidden",
        "submit",
        "button",
        "reset"
    ];

    return etiquetas.includes(campo.tagName)
        && !tiposExcluidos.includes(campo.type)
        && !campo.disabled;
}

/* CONFIGURAR EVENTOS */

function configurarCampo(campo) {

    campo.addEventListener(
        "input",
        validarAlEscribir
    );

    campo.addEventListener(
        "blur",
        validarAlSalir
    );

    // change permite validar selects al elegir una opción.
    campo.addEventListener(
        "change",
        validarAlCambiar
    );
}

/* EVENTO INPUT */

function validarAlEscribir(evento) {

    const campo = evento.currentTarget;

    validarCampo(campo);

    ocultarAlerta(campo.form);
}

/* EVENTO BLUR */

function validarAlSalir(evento) {

    const campo = evento.currentTarget;

    validarCampo(campo);
}

/* EVENTO CHANGE */

function validarAlCambiar(evento) {

    const campo = evento.currentTarget;

    validarCampo(campo);

    ocultarAlerta(campo.form);
}

/* VALIDACIÓN INDIVIDUAL */

function validarCampo(campo) {

    const valor = campo.value.trim();

    let esValido = true;

    // Validar campos obligatorios.
    if (campo.required && valor === "") {

        esValido = false;

    }

    // Validar formato del correo.
    else if (campo.type === "email" && valor !== "") {

        const expresionCorreo =
            /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!expresionCorreo.test(valor)) {
            esValido = false;
        }
    }

    // Validar restricciones HTML5.
    if (!campo.checkValidity()) {
        esValido = false;
    }

    // Validar longitud sin espacios exteriores.
    if (valor !== "") {

        const minimo = campo.minLength;
        const maximo = campo.maxLength;

        if (minimo >= 0 && valor.length < minimo) {
            esValido = false;
        }

        if (maximo >= 0 && valor.length > maximo) {
            esValido = false;
        }
    }

    // Mostrar validación verde o roja.
    campo.classList.toggle(
        "is-valid",
        esValido && valor !== ""
    );

    campo.classList.toggle(
        "is-invalid",
        !esValido
    );

    campo.setAttribute(
        "aria-invalid",
        String(!esValido)
    );

    return esValido;
}

/* VALIDAR AL ENVIAR */

function validarFormulario(evento) {

    const formulario = evento.currentTarget;

    const campos = obtenerCampos(formulario);

    const camposIncorrectos = [];

    campos.forEach(function (campo) {

        if (!validarCampo(campo)) {

            const nombre =
                campo.dataset.nombre ||
                campo.name ||
                campo.id;

            camposIncorrectos.push(nombre);
        }
    });

    // Prevenir envío si existen errores.
    if (camposIncorrectos.length > 0) {

        evento.preventDefault();

        mostrarAlerta(
            formulario,
            camposIncorrectos,
            false
        );

        return;
    }

    /*
     * Demostración frontend:
     * evitar el envío real hasta conectar un backend.
     */
    evento.preventDefault();

    mostrarAlerta(
        formulario,
        [],
        true
    );
}

/* OBTENER ELEMENTOS DE ALERTA */

function obtenerElementosAlerta(formulario) {

    let idAlerta = "";
    let idMensaje = "";
    let idLista = "";

    switch (formulario.id) {

        case "formularioContacto":

            idAlerta = "alertaContacto";
            idMensaje = "mensajeAlertaContacto";
            idLista = "listaCamposContacto";

            break;

        case "formularioLogin":

            idAlerta = "alertaLogin";
            idMensaje = "mensajeAlertaLogin";
            idLista = "listaCamposLogin";

            break;

        case "formReporte":

            idAlerta = "alertaReporte";
            idMensaje = "mensajeAlertaReporte";
            idLista = "listaCamposReporte";

            break;

        default:
            return null;
    }

    // Seleccionar elementos por identificador único.
    const alerta = document.getElementById(idAlerta);
    const mensaje = document.getElementById(idMensaje);
    const lista = document.getElementById(idLista);

    if (!alerta || !mensaje || !lista) {
        return null;
    }

    return {
        alerta: alerta,
        mensaje: mensaje,
        lista: lista
    };
}

/* MOSTRAR ALERTAS */

function mostrarAlerta(
    formulario,
    camposIncorrectos,
    correcto
) {

    const elementos = obtenerElementosAlerta(formulario);

    if (elementos === null) {
        return;
    }

    const alerta = elementos.alerta;
    const mensaje = elementos.mensaje;
    const lista = elementos.lista;

    // Limpiar mensajes anteriores.
    lista.replaceChildren();

    if (correcto) {

        alerta.classList.remove(
            "d-none",
            "alert-danger"
        );

        alerta.classList.add("alert-success");

        mensaje.textContent =
            "Formulario validado correctamente. " +
            "Los datos no se han enviado todavía.";

    } else {

        alerta.classList.remove(
            "d-none",
            "alert-success"
        );

        alerta.classList.add("alert-danger");

        mensaje.textContent =
            "Completa correctamente los siguientes campos:";

        camposIncorrectos.forEach(function (nombre) {

            const elemento = document.createElement("li");

            elemento.textContent = nombre;

            lista.appendChild(elemento);
        });
    }

    alerta.scrollIntoView({
        behavior: "smooth",
        block: "center"
    });
}

/* OCULTAR ALERTA AL CORREGIR */

function ocultarAlerta(formulario) {

    if (!formulario) {
        return;
    }

    const elementos = obtenerElementosAlerta(formulario);

    if (elementos === null) {
        return;
    }

    elementos.alerta.classList.add("d-none");
}
>>>>>>> main
