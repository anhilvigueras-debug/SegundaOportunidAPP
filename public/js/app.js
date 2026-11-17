const CLAVE_TEMA = "tema-segunda-oportunidad";

function obtenerTemaGuardado() {
    try {
        return localStorage.getItem(CLAVE_TEMA) || "light";
    } catch (error) {
        return "light";
    }
}

function guardarTema(tema) {
    try {
        localStorage.setItem(CLAVE_TEMA, tema);
    } catch (error) {
    }
}

function aplicarTema(tema) {
    document.documentElement.setAttribute("data-bs-theme", tema);
    const botonTema = document.querySelector("#btn-tema");
    if (botonTema) {
        botonTema.textContent = tema === "dark" ? "☀️ Tema Claro" : "🌙 Tema Oscuro";
    }
}

function alternarTema() {
    const temaActual = document.documentElement.getAttribute("data-bs-theme") || "light";
    const nuevoTema = temaActual === "dark" ? "light" : "dark";
    guardarTema(nuevoTema);
    aplicarTema(nuevoTema);
}

document.documentElement.setAttribute("data-bs-theme", obtenerTemaGuardado());

document.addEventListener("DOMContentLoaded", function () {
    aplicarTema(obtenerTemaGuardado());

    const botonTema = document.querySelector("#btn-tema");
    if (botonTema) {
        botonTema.addEventListener("click", alternarTema);
    }
});