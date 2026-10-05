
document.addEventListener("DOMContentLoaded", function () {

    /*
     * Busca todos los formularios que tengan
     * la clase "form-validado".
     */
    const formularios =
        document.querySelectorAll(".form-validado");
    /* Se configura cada formulario encontrado.*/
    formularios.forEach(function (formulario) {
        formulario.addEventListener(
            "submit",
            function (event) {
                /*Evita el envío real del formulario. Por el momento la interfaz es estática.*/
                event.preventDefault();
                /*ELEMENTOS DEL ALERT*/
                const alerta =
                    formulario.querySelector(
                        ".alerta-validacion"
                    );

                const mensajeAlerta =
                    formulario.querySelector(
                        ".mensaje-alerta"
                    );

                const listaCampos =
                    formulario.querySelector(
                        ".lista-campos"
                    );
                /*CAMPOS OBLIGATORIOS*/
                const campos =
                    formulario.querySelectorAll(
                        "input[required], " +
                        "textarea[required], " +
                        "select[required]"
                    );
                /*Aquí guardaremos los nombres de los campos incorrectos.*/
                const camposIncorrectos = [];
                /*VALIDAR CAMPOS*/
                campos.forEach(function (campo) {
                    /*checkValidity() revisa las reglas HTML5 del campo: required, type, pattern, minlength, maxlength                     */
                    if (!campo.checkValidity()) {
                        const nombreCampo =
                            campo.dataset.nombre ||
                            campo.name ||
                            campo.id;

                        camposIncorrectos.push(
                            nombreCampo
                        );


                        /*Bootstrap mostrará visualmente que el campo es incorrecto.
                         */
                        campo.classList.add(
                            "is-invalid"
                        );

                        campo.classList.remove(
                            "is-valid"
                        );

                    } else {

                        /*El campo es correcto.*/
                        campo.classList.remove(
                            "is-invalid"
                        );

                        campo.classList.add(
                            "is-valid"
                        );

                    }

                });
                /*SI HAY CAMPOS INCORRECTOS*/
                if (camposIncorrectos.length > 0) {

                    /*Limpiar la lista anterior.*/
                    listaCampos.innerHTML = "";
                    /*Crear un <li> por cada campo pendiente o incorrecto.*/
                    camposIncorrectos.forEach(
                        function (nombre) {
                            const elemento =
                                document.createElement(
                                    "li"
                                );
                            elemento.textContent =
                                nombre;
                            listaCampos.appendChild(
                                elemento
                            );

                        }
                    );
                    /*Configurar Bootstrap Alert como alerta de error. */
                    alerta.classList.remove(
                        "d-none",
                        "alert-success"
                    );
                    alerta.classList.add(
                        "alert-danger"
                    );
                    mensajeAlerta.textContent =
                        "Completa correctamente los siguientes campos:";
                    /*Llevar al usuario hacia la alerta.*/
                    alerta.scrollIntoView({
                        behavior: "smooth",
                        block: "center"
                    });
                    /*Detener aquí.*/
                    return;
                }


                /*FORMULARIO CORRECTO*/

                listaCampos.innerHTML = "";


                alerta.classList.remove(
                    "d-none",
                    "alert-danger"
                );

                alerta.classList.add(
                    "alert-success"
                );


                mensajeAlerta.textContent =
                    "Formulario completado correctamente.";


                /*Llevar al usuario hacia el mensaje de confirmación.*/
                alerta.scrollIntoView({
                    behavior: "smooth",
                    block: "center"
                });

            }
        );
        /*QUITAR ERROR AL CORREGIR EL CAMPO */

        const camposFormulario =
            formulario.querySelectorAll(
                "input, textarea, select"
            );
        camposFormulario.forEach(function (campo) {

            campo.addEventListener(
                "input",
                function () {

                    /*Si el usuario corrige el campo, actualizamos su estado visual.*/
                    if (campo.checkValidity()) {

                        campo.classList.remove(
                            "is-invalid"
                        );

                        campo.classList.add(
                            "is-valid"
                        );

                    } else {

                        campo.classList.remove(
                            "is-valid"
                        );

                    }

                }
            );

        });

    });

});
