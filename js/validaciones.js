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