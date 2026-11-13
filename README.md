# SegundaOportunidAPP · Laravel

Proyecto académico de publicaciones, ventas y aportaciones. Las ventas se registran manualmente y se calcula la comisión; las aportaciones guardan su comprobante en la base de datos para revisión. **No hay pasarela de pagos, cobro real ni verificación automática**. Esta versión tampoco tiene autenticación ni permisos; utilízala solo con datos de prueba en un entorno local, no con comprobantes reales ni en producción.

## Requisitos

PHP 8.3 o superior con las extensiones `pdo_pgsql` y `pgsql`, Composer y PostgreSQL. Bootstrap se carga desde CDN.

## Instalación desde cero (PowerShell)

1. Crear una base de datos vacía en PostgreSQL, por ejemplo `segunda_oportunidad`, usando pgAdmin o `createdb`.
2. En la carpeta del proyecto:

```powershell
composer install
Copy-Item .env.example .env
```

3. Editar `.env`: completar `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` y `DB_PASSWORD` con los datos locales. No compartir ni subir `.env`.
4. Ejecutar:

```powershell
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Abrir la dirección que muestre Artisan. Para comenzar de nuevo con datos de ejemplo, usar `php artisan migrate:fresh --seed`. **Este último comando elimina todas las tablas y sus datos**; úsalo únicamente en una base de pruebas.

## Flujo de ejemplo

Crear una publicación de tipo venta con precio mayor que cero, abrir Ventas y registrar el comprador. El importe se toma del precio de la publicación y se guarda junto con la comisión y el saldo del vendedor. Una publicación admite una sola venta; para conservar la integridad, no puede borrarse mientras exista el registro de venta.

Desde Aportar se registran nombre, correo, monto, referencia única y comprobante PDF/JPG/PNG (máximo 2 MB). El archivo se guarda en la base como texto codificado y puede descargarse. Registrar un comprobante no demuestra que la operación se haya realizado. Se pueden consultar, editar y eliminar los registros.

`COMISION_PUNTOS_BASE=500` en `.env` representa un **5% de ejemplo**, no una tarifa aprobada: 100 puntos base equivalen a 1%. El equipo puede cambiar el valor de 0 a 10000 antes de registrar nuevas ventas. Cada venta conserva la tasa vigente en el momento de su registro; editar el comprador no altera sus importes. La comisión se redondea al centavo más cercano.

Las pruebas usan SQLite en memoria para no tocar la base PostgreSQL configurada: `php artisan test`. Debe probarse también `migrate` y `migrate:fresh --seed` en una base PostgreSQL independiente.
