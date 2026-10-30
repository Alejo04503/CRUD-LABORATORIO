<?php
/*
 * Conexión a la base de datos CRUD.
 * En XAMPP normalmente el usuario es root y la contraseña está vacía.
 * Si tu instalación tiene otra contraseña, cámbiala aquí.
 */

$host = 'localhost';
$dbname = 'CRUD';
$usuario = 'root';
$contrasena = '';

try {
    $conexion = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $usuario,
        $contrasena
    );

    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $error) {
    // No mostramos credenciales ni detalles internos al visitante.
    die('No fue posible conectar con la base de datos. Verifica XAMPP y la configuración de conexion.php.');
}

/**
 * Escapa texto antes de mostrarlo dentro del HTML.
 */
function escapar($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}
