# SegundaOportunidAPP 🐾

**Asignatura:** Aplicaciones Web  
**Práctica:** Interacciones con selectores, eventos y funciones en nuestra aplicación web (Bootstrap)  
**Equipo:**

- Anhil Vigueras Mendoza(Líder Técnico)
- Luis Uriel Azpetia Escamilla
- Marco Antonio Zarco Espinoza
- Angel Daniel Martinez Rendon
- Diego Cervantes Perez
- Zayra OLvera Hernandez

---

## Sitio Publicado

El sitio web se encuentra desplegado en GitHub Pages:  
 [https://anhilvigueras-debug.github.io/SegundaOportunidAPP/](https://anhilvigueras-debug.github.io/SegundaOportunidAPP/)

---

## Tabla de Interacciones JavaScript

## Evidencias de Interacciones y Tablero Kanban

![tablaInteracciones](tablaInteracciones.png)

### Tablero Kanban (GitHub Projects)

![TableroK](TableroK.png)

### Capturas de Pantalla de las Interacciones

1. **Validación de Formulario:**
   ![validacion1](validacion1.png)
   ![validacion2](validacion2.png)
   ![validacion3](validacion3.png)

2. **Modales Dinámicos:**
   ![modal](modal.png)
   ![modal1](modal1.png)
   ![modal3](modal3.png)

3. **Notificaciones Toast:**
   ![notif1](notif1.png)

4. **Filtrado / Búsqueda:**
   ![fil1](fil1.png)
   ![fil2](fil2.png)
   ![fil3](fil3.png)
5. **Agregar y Eliminar Elementos:**
   ![ae1](ae1.png)
   ![ae2](ae2.png)
   ![ae3](ae3.png)
6. **Cambio de Tema Claro/Oscuro:**
   ![os1](os1.png)
   ![os2](os2.png)
   ![os3](os3.png)

---

## Reflexión del Equipo

### Anhil Vigueras Mendoza

> Trabajar en los modales dinámicos fue un reto técnico bastante completo y por momentos un poco difícil.
> Lo complicado fue lograr que un solo modal reutilizable capturara los datos dinámicos mediante `dataset`.
> Necesitábamos pintar la información en pantalla en tres vistas distintas sin recurrir al típico `onclick`.
> Al inicio nos costó coordinar la lectura limpia del DOM con `querySelectorAll` y organizar las fusiones en Git.
> También tuvimos que lidiar con algunos detalles en el flujo de trabajo antes de dejar la rama estable.
> Sin embargo, aplicando `addEventListener` y funciones con nombre bien estructuradas, logramos resolverlo todo.
> Al final el código quedó limpio, los modales respondieron perfecto y la experiencia nos sirvió muchísimo.
> Comprendí en la práctica el verdadero valor de manipular el DOM de forma eficiente y desacoplada del HTML.

### Luis Uiriel

> Con esta tarea aprendí a usar JavaScript para modificar el contenido de una página sin recargarla.
> En `perfil.html`, `admin.html` y `mensajes.html` agregué elementos nuevos con `createElement` y `appendChild`, y los eliminé con `remove()`.
> Algo importante fue usar delegación de eventos: en lugar de un `onclick` en cada botón, coloqué un solo `addEventListener` en el contenedor padre.
> Así los botones creados dinámicamente también funcionan sin código adicional y el HTML queda limpio.
> En la tabla de administración los totales se recalculan automáticamente gracias a los atributos `data-` de cada fila.
> Organizar todo en funciones con nombre dentro de `delegacion.js` hizo el código más ordenado y fácil de mantener.

### Angel Daniel

> Se corrigieron los buscadores duplicados y se unificó su funcionamiento mediante un archivo JavaScript.
> Esto facilitó las búsquedas en las páginas de inicio (`index.html`) y servicios (`servicios.html`).
> Aprendí a actualizar el proyecto y subir los cambios a Git correctamente para mantener un buen trabajo colaborativo.

### Diego Cervantes

> En conclusión, SegundaOportunidAPP mejoró gracias a las nuevas funcionalidades implementadas.
> En la página de contacto, agregamos mensajes Toast para confirmar las acciones del usuario.
> En la página de reporte, facilitamos el envío de información sobre problemas encontrados.
> En la página de validaciones, implementamos comprobaciones para evitar errores en los formularios.
> Estas funciones ayudan a que la aplicación sea más clara y fácil de utilizar.
> También permiten que los usuarios reciban mensajes útiles al completar los campos.
> Para lograrlo, utilizamos HTML, Bootstrap y JavaScript.
> Además, usamos Git para guardar y organizar los cambios realizados.
> Este proyecto nos ayudó a reforzar nuestros conocimientos de desarrollo web.
> Finalmente, aprendimos la importancia de trabajar en equipo y mejorar la experiencia del usuario.

### Marco Antonio

> Durante el desarrollo de la práctica, la interacción más difícil fue implementar las validaciones en tiempo real de los formularios.
> Esto se debió a que necesitábamos verificar los datos mientras el usuario escribía y al salir de cada campo.
> También fue importante evitar que los formularios se enviaran cuando existieran errores.
> Aprendimos que la delegación de eventos permite administrar varios elementos desde un mismo contenedor, reduciendo código repetitivo.
> Además, facilita el mantenimiento y permite trabajar con elementos que se agreguen dinámicamente.
> Al combinar JavaScript con Bootstrap, logramos mostrar mensajes de error y confirmación de manera más clara.
> Utilizamos las clases `is-valid` e `is-invalid` para identificar visualmente los campos correctos e incorrectos.
> También comprendimos la importancia de utilizar `addEventListener` para separar los eventos del código HTML.
> Esta práctica nos ayudó a mejorar la experiencia del usuario y la organización de nuestro código.
> Como equipo, reforzamos nuestros conocimientos sobre validación de formularios, eventos y diseño de interfaces web.

### Zayra Olvera

> Desarrollar esta aplicación web ha sido una experiencia muy importante para mí, porque aprendí cosas nuevas y pude ver cómo nuestras ideas se convirtieron en un proyecto real.
> Me di cuenta de que no solo se trata de hacer la página sino también de pensar en las personas que la utilizarán, como agregar la función de cambiar el tema.
> Además, aprendí que trabajar en equipo, compartir ideas y ayudarnos a resolver errores es necesario para lograr buenos resultados.
> Aunque hubo errores, aprendimos y con esfuerzo logramos terminar nuestro trabajo.