<?php
/*
 * Conexión del proyecto CRUD con MySQL 8.4.
 *
 * Apache puede ejecutarse desde XAMPP y conectarse a MySQL 8.4
 * instalado como servicio de Windows. No es necesario iniciar
 * MariaDB de XAMPP.
 *
 * IMPORTANTE:
 * 1. Deja el host y puerto como están si MySQL usa el puerto 3306.
 * 2. Escribe la contraseña de tu usuario MySQL en $contrasena.
 * 3. No publiques tu contraseña en GitHub.
 */

$host = '127.0.0.1';
$puerto = '3306';
$dbname = 'CRUD';
$usuario = 'root';
$contrasena = 'ESCRIBE_AQUI_TU_CONTRASENA';

try {
    $conexion = new PDO(
        "mysql:host=$host;port=$puerto;dbname=$dbname;charset=utf8mb4",
        $usuario,
        $contrasena
    );

    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $error) {
    // No mostramos credenciales ni detalles internos al visitante.
    die('No fue posible conectar con MySQL 8.4. Verifica que el servicio esté iniciado, que exista la base CRUD y que las credenciales de conexion.php sean correctas.');
}

/**
 * Escapa texto antes de mostrarlo dentro del HTML.
 */
function escapar($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}
