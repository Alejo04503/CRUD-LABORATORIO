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

- XAMPP con Apache y MySQL/MariaDB.
- PHP con PDO y el controlador PDO MySQL habilitados.
- Navegador web.

## Instalación local

1. Clona el repositorio dentro de `C:\xampp\htdocs`:

   ```bash
   git clone https://github.com/Alejo04503/CRUD-LABORATORIO.git
   ```

2. Abre el panel de XAMPP e inicia **Apache** y **MySQL**.
3. Entra a phpMyAdmin: `http://localhost/phpmyadmin`.
4. Importa el archivo `bd/crud.sql`. Este crea la base de datos independiente `CRUD` y la tabla `PERSONA`; no elimina ni modifica otras bases.
5. Revisa `conexion.php`. La configuración inicial usa `localhost`, usuario `root` y contraseña vacía, que es la configuración habitual de XAMPP. Ajusta esos datos si tu instalación es diferente.
6. Abre el proyecto: `http://localhost/CRUD-LABORATORIO/`.

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

La estructura y los archivos iniciales del CRUD ya están en el repositorio. Antes de darlo por probado, hay que importar la base de datos y ejecutar el proyecto en el XAMPP local para comprobar la conexión y las cuatro operaciones.
