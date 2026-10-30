<?php
require_once 'conexion.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
}

if (!$id || $id < 1) {
    header('Location: index.php');
    exit;
}

$consulta = $conexion->prepare('SELECT * FROM PERSONA WHERE id = :id');
$consulta->execute(['id' => $id]);
$persona = $consulta->fetch();

if (!$persona) {
    header('Location: index.php');
    exit;
}

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $campos = ['nombre', 'apellidos', 'telefono', 'ciudad', 'correo'];
    foreach ($campos as $campo) {
        $persona[$campo] = trim($_POST[$campo] ?? '');
        if ($persona[$campo] === '') {
            $errores[] = 'Todos los campos son obligatorios.';
            break;
        }
        if (mb_strlen($persona[$campo]) > 45) {
            $errores[] = 'Cada campo debe tener máximo 45 caracteres.';
            break;
        }
    }

    if ($persona['correo'] !== '' && !filter_var($persona['correo'], FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'El correo electrónico no tiene un formato válido.';
    }

    if (empty($errores)) {
        $actualizar = $conexion->prepare(
            'UPDATE PERSONA
             SET nombre = :nombre,
                 apellidos = :apellidos,
                 telefono = :telefono,
                 ciudad = :ciudad,
                 correo = :correo
             WHERE id = :id'
        );
        $actualizar->execute([
            'nombre' => $persona['nombre'],
            'apellidos' => $persona['apellidos'],
            'telefono' => $persona['telefono'],
            'ciudad' => $persona['ciudad'],
            'correo' => $persona['correo'],
            'id' => $id
        ]);

        header('Location: index.php?estado=actualizado');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar persona</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <main class="contenedor contenedor-formulario">
        <a class="enlace-volver" href="index.php">← Volver al listado</a>
        <section class="panel formulario-panel">
            <p class="etiqueta">Operación UPDATE</p>
            <h1>Editar persona #<?= escapar($id) ?></h1>
            <p class="subtitulo">Modifica los campos y guarda los cambios.</p>

            <?php if (!empty($errores)): ?>
                <div class="alerta alerta-error">
                    <?php foreach (array_unique($errores) as $error): ?>
                        <p><?= escapar($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="update.php" class="formulario">
                <input type="hidden" name="id" value="<?= escapar($id) ?>">
                <label>Nombre
                    <input type="text" name="nombre" maxlength="45" value="<?= escapar($persona['nombre']) ?>" required>
                </label>
                <label>Apellidos
                    <input type="text" name="apellidos" maxlength="45" value="<?= escapar($persona['apellidos']) ?>" required>
                </label>
                <label>Teléfono
                    <input type="text" name="telefono" maxlength="45" value="<?= escapar($persona['telefono']) ?>" required>
                </label>
                <label>Ciudad
                    <input type="text" name="ciudad" maxlength="45" value="<?= escapar($persona['ciudad']) ?>" required>
                </label>
                <label>Correo electrónico
                    <input type="email" name="correo" maxlength="45" value="<?= escapar($persona['correo']) ?>" required>
                </label>
                <div class="acciones-formulario">
                    <button class="boton boton-principal" type="submit">Guardar cambios</button>
                    <a class="boton boton-claro" href="index.php">Cancelar</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
