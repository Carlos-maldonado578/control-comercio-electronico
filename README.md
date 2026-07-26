# Control Comercio Electrónico

Proyecto de actualización de una tienda de comercio electrónico, desarrollado como parte de la asignatura Programación Web II (IACC). Incorpora búsqueda y filtrado de productos, carrito de compras, procesamiento de pagos en línea y notificaciones de promociones y descuentos.

## Funcionalidades

- Búsqueda y filtrado de productos
- Gestión de carrito de compras
- Procesamiento de pagos en línea
- Gestión de pedidos (creación, consulta y actualización de estado)
- Notificaciones de promociones y descuentos

## Tecnologías utilizadas

- **Frontend:** HTML5, CSS3, Bootstrap 5, JavaScript
- **Backend:** PHP (orientado a objetos, PDO)
- **Base de datos:** MySQL
- **Control de versiones:** Git y GitHub

## Estructura del proyecto

```
control-comercio-electronico/
├── README.md
├── .gitignore
├── src/
│   ├── backend/
│   │   ├── GestionPedidos.php
│   │   ├── conexion.php
│   │   └── pasarela_pago/
│   ├── frontend/
│   │   ├── index.html
│   │   ├── css/estilos.css
│   │   └── js/carrito.js
├── database/
│   └── esquema.sql
└── tests/
    └── GestionPedidosTest.php
```

## Requisitos previos

- XAMPP (Apache + MySQL + PHP) instalado localmente
- Git instalado
- Un editor de código (VS Code, PhpStorm, u otro)

## Instalación y ejecución en entorno local (XAMPP)

1. Clonar el repositorio dentro de la carpeta `htdocs` de XAMPP:
   ```
   cd C:/xampp/htdocs
   git clone https://github.com/Carlos-maldonado578/control-comercio-electronico.git
   ```
2. Iniciar los módulos **Apache** y **MySQL** desde el panel de control de XAMPP.
3. Crear la base de datos en phpMyAdmin (`http://localhost/phpmyadmin`) e importar el archivo `database/esquema.sql`.
4. Configurar las credenciales de conexión en `src/backend/conexion.php` (host, usuario, contraseña y nombre de la base de datos).
5. Acceder al proyecto desde el navegador:
   ```
   http://localhost/control-comercio-electronico/src/frontend/index.html
   ```

## Flujo de trabajo con ramas

- `main`: rama principal, contiene la versión estable del proyecto.
- `feature/nombre-funcionalidad`: ramas de desarrollo para nuevas funcionalidades (ej. `feature/gestion-pedidos`).

Todo cambio se integra a `main` mediante Pull Request, con revisión y aprobación de al menos un colaborador antes de realizar el merge.

## Colaboradores

- Carlos Maldonado ([@Carlos-maldonado578](https://github.com/Carlos-maldonado578)) — Owner
- Luis Fuentes     ([@luisbergen1986](https://github.com/luisbergen1986)) — Colaborador

## Estado del proyecto

En desarrollo — actividad académica de la asignatura Programación Web II, Unidad 3 (Full Stack: Git y GitHub).
