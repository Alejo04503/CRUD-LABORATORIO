<?php
require_once 'conexion.php';

$buscar = trim($_GET['buscar'] ?? '');

if ($buscar !== '') {
    // La guía propone buscar por nombre o apellidos.
    $consulta = $conexion->prepare(
        'SELECT * FROM PERSONA
         WHERE nombre LIKE :buscar
            OR apellidos LIKE :buscar
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
    <title>CRUD en PHP con MySQL</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <main class="contenedor">
        <h1>CRUD EN PHP CON MYSQL</h1>

        <?php if (isset($mensajes[$estado])): ?>
            <div class="alerta alerta-exito"><?= escapar($mensajes[$estado]) ?></div>
        <?php endif; ?>

        <section class="panel">
            <form class="busqueda" method="GET" action="index.php">
                <input
                    type="search"
                    name="buscar"
                    placeholder="buscar nombre o apellidos"
                    value="<?= escapar($buscar) ?>"
                    aria-label="Buscar nombre o apellidos"
                >
                <button class="boton boton-buscar" type="submit">Buscar</button>
                <?php if ($buscar !== ''): ?>
                    <a class="boton boton-secundario" href="index.php">Limpiar</a>
                <?php endif; ?>
                <a class="boton boton-nuevo" href="insert.php">Nuevo</a>
            </form>

            <div class="tabla-contenedor">
                <table>
                    <thead class="head">
                        <tr>
                            <th>Id</th>
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
                                        <a class="boton-editar" href="update.php?id=<?= urlencode($persona['id']) ?>">Editar</a>
                                        <form method="POST" action="delete.php" onsubmit="return confirm('¿Seguro que deseas eliminar este registro?');">
                                            <input type="hidden" name="id" value="<?= escapar($persona['id']) ?>">
                                            <button class="boton-eliminar" type="submit">Eliminar</button>
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
