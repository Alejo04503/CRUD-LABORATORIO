# CRUD-LABORATORIO

Proyecto académico para construir un CRUD de personas utilizando PHP, MySQL, HTML y CSS, siguiendo el documento **CRUD PASO A PASO CON PHP Y MYSQL**.

## Estructura del proyecto

```text
CRUD-LABORATORIO/
├── bd/
│   └── crud.sql
├── css/
│   └── estilo.css
├── conexion.php
├── delete.php
├── index.php
├── insert.php
├── update.php
└── README.md
```

## Requisitos

- XAMPP para ejecutar Apache y PHP.
- MySQL 8.4 instalado como servicio de Windows (o un servidor MySQL compatible).
- PHP con PDO y el controlador PDO MySQL habilitados.
- Navegador web.

## Instalación local usando MySQL 8.4 con Apache de XAMPP

1. Clona el repositorio dentro de `C:\xampp\htdocs`:

   ```bash
   git clone https://github.com/Alejo04503/CRUD-LABORATORIO.git
   ```

2. Abre el panel de XAMPP e inicia **solamente Apache**. No inicies MySQL de XAMPP si MySQL 8.4 ya está utilizando el puerto 3306.
3. Comprueba que el servicio **MySQL84** esté iniciado desde Windows.
4. Abre phpMyAdmin en `http://localhost/phpmyadmin`. Si phpMyAdmin no permite iniciar sesión en MySQL 8.4, configura su servidor en `C:\xampp\phpMyAdmin\config.inc.php` para usar host `127.0.0.1`, puerto `3306` y autenticación `cookie`. Con autenticación cookie, phpMyAdmin solicitará el usuario y la contraseña al entrar; no guardes la contraseña en ese archivo.
5. En phpMyAdmin, inicia sesión con un usuario de MySQL 8.4 que tenga permisos para crear bases de datos. Importa `bd/crud.sql`. Este crea la base de datos independiente `CRUD` y la tabla `PERSONA`; no elimina ni modifica otras bases.
6. Abre `conexion.php` y reemplaza el valor de `$contrasena` por la contraseña del usuario MySQL indicado en `$usuario`. La conexión está configurada para `127.0.0.1:3306`.
7. Abre el proyecto: `http://localhost/CRUD-LABORATORIO/`.

> Seguridad: no subas contraseñas reales a GitHub. Si cambias `conexion.php` localmente, evita confirmar ese cambio con una contraseña privada.

## Funciones implementadas

- **Create:** registrar personas.
- **Read:** listar y buscar por nombre, apellidos o ciudad.
- **Update:** editar una persona por su ID.
- **Delete:** eliminar mediante POST y confirmación del navegador.

Los campos de la tabla son `id`, `nombre`, `apellidos`, `telefono`, `ciudad` y `correo`.

## Decisiones técnicas

- La conexión utiliza PDO.
- Las consultas que reciben datos utilizan parámetros preparados.
- Los valores se escapan antes de mostrarse en HTML.
- Se validan campos obligatorios y formato de correo.
- El documento menciona búsqueda por documento, pero la estructura de la tabla no define un campo documento. Para mantener el esquema del laboratorio, la búsqueda se realiza por nombre, apellidos y ciudad.
- No se incluyen datos personales reales ni credenciales privadas.

## Estado y siguiente paso

La estructura y los archivos iniciales del CRUD ya están en el repositorio. Antes de darlo por probado, hay que importar la base de datos y ejecutar el proyecto en el entorno local para comprobar la conexión y las cuatro operaciones.
