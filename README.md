# Xclusive Tours Cancún — Generador de cotizaciones

> **Proyecto deprecado / histórico.** Fue una pequeña aplicación **PHP + Alpine.js** para crear **cotizaciones de tours** de "Xclusive Tours Cancún". Ya **no está en uso ni mantenida**. Se conserva solo como recuerdo de lo que fue.

## Qué era

Dos archivos PHP:

| Archivo | Rol |
|---|---|
| `index.php` | Pantalla de **login** (Bootstrap). Valida contra credenciales **hardcodeadas** en el propio código; al entrar guarda la sesión y redirige a `admin.php`. |
| `admin.php` | **Generador de cotizaciones**, 100% en el navegador con **Alpine.js + Tailwind**. |

### El generador (`admin.php`)

- **Datos generales:** número de cotización, agente, fecha de cotización, cliente, fecha de viaje, hotel y país.
- **Líneas de la cotización:** tour, pasajeros (incl. menores), PickUp, cantidad, precio unitario, total, estado de pago y observaciones.
- **Modales:** "Agregar tour" / "Agregar servicio".
- **Cálculos:** subtotal, **impuesto (GST)** por línea y totales; genera número de factura y **UUIDs** por línea.
- **Extras:** datepicker (Pikaday), impresión **A4** (`@media print`) y logo cargado desde `xclusivetourscancun.com`.
- **Sin backend ni base de datos**: todo se arma en el cliente.

## Cómo se usaba

1. Servir con **PHP** (usa `session_start`).
2. Abrir `index.php`, iniciar sesión y llegar a `admin.php`.
3. Rellenar la cotización y **imprimir**.

## Estado

- **Deprecado.** Código antiguo, sin mantenimiento. No usar en producción.

## ⚠️ Seguridad (por qué no usarlo)

- **Credenciales hardcodeadas** en `index.php` (`'admin' => 'pass'`) y comparación **sin hashing**. La "sesión" es solo `$_SESSION['username']`.
- El "panel" no valida nada en el servidor: todo el contenido se genera **del lado del cliente**.
- Rutas y dependencias por **CDN externo** (Bootstrap, Tailwind, Alpine, Pikaday) y logo remoto: dependen de terceros.

## Licencia

Sin licencia definida.
