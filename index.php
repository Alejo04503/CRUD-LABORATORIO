<?php
require_once 'conexion.php';

$buscar = trim($_GET['buscar'] ?? '');

if ($buscar !== '') {
    // El documento del laboratorio no incluye un campo documento.
    // Por eso la búsqueda se realiza por nombre, apellidos o ciudad.
    $consulta = $conexion->prepare(
        'SELECT * FROM PERSONA
         WHERE nombre LIKE :buscar
            OR apellidos LIKE :buscar
            OR ciudad LIKE :buscar
         ORDER BY id DESC'
    );
    $consulta->execute(['buscar' => "%$buscar%"]);
} else {
    $consulta = $conexion->query('SELECT * FROM PERSONA ORDER BY id DESC');
}

$personas = $consulta->fetchAll();

$mensajes = [
    'creado' => 'Persona registrada correctamente.',
    'actualizado' => 'Persona actualizada correctamente.',
    'eliminado' => 'Persona eliminada correctamente.'
];
$estado = $_GET['estado'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de personas</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <main class="contenedor">
        <header class="encabezado">
            <div>
                <p class="etiqueta">Laboratorio PHP y MySQL</p>
                <h1>Gestión de personas</h1>
                <p class="subtitulo">Crear, consultar, actualizar y eliminar registros.</p>
            </div>
            <a class="boton boton-principal" href="insert.php">+ Nueva persona</a>
        </header>

        <?php if (isset($mensajes[$estado])): ?>
            <div class="alerta alerta-exito"><?= escapar($mensajes[$estado]) ?></div>
        <?php endif; ?>

        <section class="panel">
            <form class="busqueda" method="GET" action="index.php">
                <input
                    type="search"
                    name="buscar"
                    placeholder="Buscar por nombre, apellidos o ciudad"
                    value="<?= escapar($buscar) ?>"
                >
                <button class="boton boton-secundario" type="submit">Buscar</button>
                <?php if ($buscar !== ''): ?>
                    <a class="boton boton-claro" href="index.php">Limpiar</a>
                <?php endif; ?>
            </form>

            <div class="tabla-contenedor">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Teléfono</th>
                            <th>Ciudad</th>
                            <th>Correo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($personas) > 0): ?>
                            <?php foreach ($personas as $persona): ?>
                                <tr>
                                    <td><?= escapar($persona['id']) ?></td>
                                    <td><?= escapar($persona['nombre']) ?></td>
                                    <td><?= escapar($persona['apellidos']) ?></td>
                                    <td><?= escapar($persona['telefono']) ?></td>
                                    <td><?= escapar($persona['ciudad']) ?></td>
                                    <td><?= escapar($persona['correo']) ?></td>
                                    <td class="acciones">
                                        <a class="boton boton-editar" href="update.php?id=<?= urlencode($persona['id']) ?>">Editar</a>
                                        <form method="POST" action="delete.php" onsubmit="return confirm('¿Seguro que deseas eliminar este registro?');">
                                            <input type="hidden" name="id" value="<?= escapar($persona['id']) ?>">
                                            <button class="boton boton-eliminar" type="submit">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td class="sin-registros" colspan="7">
                                    <?= $buscar !== '' ? 'No se encontraron coincidencias.' : 'Todavía no hay personas registradas.' ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <p class="contador">Registros encontrados: <?= count($personas) ?></p>
        </section>
    </main>
</body>
</html>
