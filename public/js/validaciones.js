"use strict";


document.addEventListener("DOMContentLoaded", iniciarValidaciones);

/**
 * Inicializa la configuración de todos los formularios validables
 */
function iniciarValidaciones() {
    const formularios = [
        "formularioContacto",
        "formularioLogin",
        "formReporte"
    ];

    formularios.forEach(configurarFormulario);
}

/**
 * Configura los eventos submit y por campo de un formulario
 * @param {string} idFormulario - ID del formulario en el DOM
 */
function configurarFormulario(idFormulario) {
    const formulario = document.getElementById(idFormulario);

    if (formulario === null) {
        return;
    }

    const campos = obtenerCampos(formulario);

    campos.forEach(configurarCampo);

    formulario.addEventListener("submit", validarFormulario);
}

/**
 * Obtiene solo los campos interactivos y validables del formulario
 */
function obtenerCampos(formulario) {
    return Array.from(formulario.elements).filter(esCampoValidable);
}

function esCampoValidable(campo) {
    const etiquetas = ["INPUT", "TEXTAREA", "SELECT"];
    const tiposExcluidos = ["hidden", "submit", "button", "reset"];

    return etiquetas.includes(campo.tagName) && 
           !tiposExcluidos.includes(campo.type) && 
           !campo.disabled;
}

/**
 * Agrega los listeners para eventos de interacción en tiempo real
 */
function configurarCampo(campo) {
    campo.addEventListener("input", validarAlEscribir);
    campo.addEventListener("blur", validarAlSalir);
    campo.addEventListener("change", validarAlCambiar);
}

function validarAlEscribir(evento) {
    const campo = evento.currentTarget;
    validarCampo(campo);
    ocultarAlerta(campo.form);
}

function validarAlSalir(evento) {
    const campo = evento.currentTarget;
    validarCampo(campo);
}

function validarAlCambiar(evento) {
    const campo = evento.currentTarget;
    validarCampo(campo);
    ocultarAlerta(campo.form);
}

/**
 * Ejecuta las reglas de validación sobre un campo individual
 */
function validarCampo(campo) {
    const valor = campo.value.trim();
    let esValido = true;

    // Validar campo obligatorio
    if (campo.required && valor === "") {
        esValido = false;
    }
    // Validar formato de correo
    else if (campo.type === "email" && valor !== "") {
        const expresionCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!expresionCorreo.test(valor)) {
            esValido = false;
        }
    }

    // Validaciones nativas de HTML5 (pattern, minlength, maxlength)
    if (!campo.checkValidity()) {
        esValido = false;
    }

    // Validar longitud
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

    
    campo.classList.toggle("is-valid", esValido && valor !== "");
    campo.classList.toggle("is-invalid", !esValido);
    campo.setAttribute("aria-invalid", String(!esValido));

    return esValido;
}

/**
 * Valida todos los campos al intentar enviar el formulario
 */
function validarFormulario(evento) {
    const formulario = evento.currentTarget;
    const campos = obtenerCampos(formulario);
    const camposIncorrectos = [];

    campos.forEach(function (campo) {
        if (!validarCampo(campo)) {
            const nombre = campo.dataset.nombre || campo.name || campo.id;
            camposIncorrectos.push(nombre);
        }
    });

    if (camposIncorrectos.length > 0) {
        evento.preventDefault();
        mostrarAlerta(formulario, camposIncorrectos, false);
        return;
    }

    // Demostración Frontend (Evita envío real previo al backend)
    evento.preventDefault();
    mostrarAlerta(formulario, [], true);
}

/**
 * Retorna los elementos de alerta correspondientes a cada formulario
 */
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

    const alerta = document.getElementById(idAlerta);
    const mensaje = document.getElementById(idMensaje);
    const lista = document.getElementById(idLista);

    if (!alerta || !mensaje || !lista) {
        return null;
    }

    return { alerta, mensaje, lista };
}

/**
 * Despliega o actualiza el cuadro de alerta con los errores o éxito
 */
function mostrarAlerta(formulario, camposIncorrectos, correcto) {
    const elementos = obtenerElementosAlerta(formulario);
    if (elementos === null) return;

    const { alerta, mensaje, lista } = elementos;
    lista.replaceChildren();

    if (correcto) {
        alerta.classList.remove("d-none", "alert-danger");
        alerta.classList.add("alert-success");
        mensaje.textContent = "¡Formulario validado correctamente!";
    } else {
        alerta.classList.remove("d-none", "alert-success");
        alerta.classList.add("alert-danger");
        mensaje.textContent = "Completa correctamente los siguientes campos:";

        camposIncorrectos.forEach(function (nombre) {
            const elemento = document.createElement("li");
            elemento.textContent = nombre;
            lista.appendChild(elemento);
        });
    }

    alerta.scrollIntoView({ behavior: "smooth", block: "center" });
}

/**
 * Oculta la alerta al corregir campos
 */
function ocultarAlerta(formulario) {
    if (!formulario) return;
    const elementos = obtenerElementosAlerta(formulario);
    if (elementos === null) return;

    elementos.alerta.classList.add("d-none");
}