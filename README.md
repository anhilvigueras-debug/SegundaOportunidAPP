# SegundaOportunidAPP

Aplicación web desarrollada con **Laravel** y **PostgreSQL** para la compra, venta e intercambio de artículos de segunda mano, incluyendo gestión de publicaciones, transacciones, mensajería interna y reportes.

- **Institución:** Universidad Politécnica de Pachuca
- **Programa Educativo:** Tecnologías de la Información e Innovación Digital
- **Asignatura:** Aplicaciones Web (Septiembre–Diciembre 2026)
- **Docente:** Maestra Yeniza Sarahi Montoya Martínez
- **Repositorio:** `https://github.com/anhilvigueras-debug/SegundaOportunidAPP`

---

## Integrantes del equipo

- **Anhil Vigueras Mendoza**
- **Zayra Olvera Hernández**
- **Luis Uriel Azpeitia Escamilla**
- **Ángel Daniel Martínez Rendón**
- **Marco Antonio Zarco Espinoza**
- **Diego Pérez Cervantes**

---

## Estructura de directorios del proyecto

Arquitectura **MVC** de Laravel organizada por módulos:

```text
SegundaOportunidAPP/
├── app/
│   ├── Http/
│   │   └── Controllers/          # Lógica de controladores RESTful (ReporteController, etc.)
│   ├── Models/                   # Modelos Eloquent con $fillable y relaciones (User, Publicacion, Transaccion, Conversacion, Mensaje, Reporte)
│   └── Providers/                # Proveedores de servicios de la aplicación
├── bootstrap/                    # Arranque y caché del framework
├── config/                       # Configuración de base de datos (pgsql), sesiones y app
├── database/
│   ├── factories/                # Fábricas de datos de prueba
│   ├── migrations/               # Esquema relacional en PostgreSQL (users, publicacions, transacciones, conversaciones, mensajes, reportes)
│   └── seeders/                  # Poblado inicial de datos (DatabaseSeeder)
├── docs/                         # Documentación técnica complementaria
├── public/                       # Punto de entrada (index.php) y recursos públicos compilados
├── resources/
│   ├── css/                      # Hojas de estilo fuente
│   ├── js/                       # Scripts frontend
│   └── views/                    # Plantillas Blade organizadas por módulo con layout compartido
│       ├── layouts/              # Plantilla base (@extends / @section)
│       ├── publicacions/         # Vistas CRUD de publicaciones
│       ├── transacciones/        # Vistas CRUD de transacciones
│       ├── conversaciones/       # Vistas de mensajería y chat
│       └── reportes/             # Vistas CRUD de reportes
├── routes/
│   └── web.php                   # Definición de rutas RESTful (Route::resource)
├── .env.example                  # Plantilla de variables de entorno sin credenciales reales
├── composer.json                 # Dependencias de PHP / Laravel
└── package.json                  # Dependencias frontend (Vite / Tailwind)
```

---

## Requisitos previos

Para ejecutar este proyecto en un entorno local es necesario contar con:

- **PHP >= 8.2** (con las extensiones `pdo_pgsql` y `pgsql` habilitadas en `php.ini`).
- **Composer** (gestor de dependencias de PHP).
- **PostgreSQL >= 14** en ejecución.
- **Node.js y NPM** (para compilar los estilos y recursos con Vite).

---

## Instalación y ejecución desde cero

Sigue estos pasos después de clonar el repositorio:

### 1. Clonar el proyecto e ingresar a la carpeta

```bash
git clone https://github.com/anhilvigueras-debug/SegundaOportunidAPP.git
```

### 2. Instalar dependencias de backend y frontend

```bash
composer install
npm install
npm run build
```

### 3. Configurar el archivo de entorno (`.env`)

Crea tu archivo `.env` a partir de la plantilla `.env.example` y genera la clave de aplicación de Laravel:

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurar la conexión a PostgreSQL

Crea una base de datos vacía en PostgreSQL llamada `segunda_oportunidad` y edita las siguientes variables dentro de tu archivo `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=segunda_oportunidad
DB_USERNAME=postgres
DB_PASSWORD=tu_contraseña_local
```

### 5. Ejecutar migraciones y seeders

Construye toda la estructura de tablas relacionales y carga los datos iniciales desde cero:

```bash
php artisan migrate:fresh --seed
```

### 6. Levantar el servidor local

```bash
php artisan serve
```

Accede desde tu navegador a: **`http://127.0.0.1:8000`**

---

## Módulos CRUD y Arquitectura del Sistema

El sistema implementa rutas RESTful (`Route::resource`), plantillas **Blade** con layout compartido y persistencia relacional en **PostgreSQL**:

1. **Publicaciones (`publicacions`):** Creación, listado con filtros/búsqueda, edición con precarga de datos y eliminación controlada de artículos.
2. **Transacciones (`transacciones`):** Registro y seguimiento completo de operaciones entre compradores y vendedores.
3. **Mensajería (`conversaciones` y `mensajes`):** Hilos de comunicación directa asociados a publicaciones y usuarios.
4. **Reportes (`reportes`):** Gestión completa (CRUD) de reportes sobre publicaciones con estados y trazabilidad.
5. **Usuarios (`users`):** Registro, autenticación y administración de perfiles de usuario.

### Aportaciones individuales por integrante

#### Anhil Vigueras Mendoza — Catálogo, Búsqueda, Detalle y Estado de Publicaciones

En este módulo me encargué de crear las vistas y funciones para consultar y gestionar las publicaciones dentro de la plataforma. Programé el catálogo público para que mostrara únicamente los artículos disponibles, añadiendo un buscador por palabras clave (sin importar mayúsculas o minúsculas) y un filtro para separar entre ventas y donaciones, manteniendo siempre visibles las opciones que el usuario seleccionó.

También trabajé en la vista de detalle de cada artículo para que, al entrar a una publicación, cualquier persona interesada pueda ver toda su información junto con el nombre, ciudad y teléfono del dueño para ponerse de acuerdo en la entrega. Por último, integré dentro del perfil del usuario el historial completo de sus publicaciones y añadí el botón para marcar un artículo como finalizado; al usarlo, el sistema verifica que sea el dueño real, pide confirmación y oculta automáticamente la publicación del catálogo público sin borrar su registro de la base de datos.
