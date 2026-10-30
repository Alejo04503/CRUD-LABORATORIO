<?php
require_once 'conexion.php';

$errores = [];
$datos = [
    'nombre' => '',
    'apellidos' => '',
    'telefono' => '',
    'ciudad' => '',
    'correo' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($datos as $campo => $valor) {
        $datos[$campo] = trim($_POST[$campo] ?? '');
        if ($datos[$campo] === '') {
            $errores[] = 'Todos los campos son obligatorios.';
            break;
        }
    }

    if ($datos['correo'] !== '' && !filter_var($datos['correo'], FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'El correo electrónico no tiene un formato válido.';
    }

    foreach ($datos as $valor) {
        if (mb_strlen($valor) > 45) {
            $errores[] = 'Cada campo debe tener máximo 45 caracteres.';
            break;
        }
    }

    if (empty($errores)) {
        $consulta = $conexion->prepare(
            'INSERT INTO PERSONA (nombre, apellidos, telefono, ciudad, correo)
             VALUES (:nombre, :apellidos, :telefono, :ciudad, :correo)'
        );
        $consulta->execute($datos);

        header('Location: index.php?estado=creado');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar persona</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <main class="contenedor contenedor-formulario">
        <a class="enlace-volver" href="index.php">← Volver al listado</a>
        <section class="panel formulario-panel">
            <h1 class="titulo-formulario">CRUD EN PHP CON MYSQL</h1>

            <?php if (!empty($errores)): ?>
                <div class="alerta alerta-error">
                    <?php foreach (array_unique($errores) as $error): ?>
                        <p><?= escapar($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="insert.php" class="formulario">
                <label><span>Nombre</span>
                    <input type="text" name="nombre" maxlength="45" placeholder="Nombre" value="<?= escapar($datos['nombre']) ?>" required>
                </label>
                <label><span>Apellidos</span>
                    <input type="text" name="apellidos" maxlength="45" placeholder="Apellidos" value="<?= escapar($datos['apellidos']) ?>" required>
                </label>
                <label><span>Teléfono</span>
                    <input type="text" name="telefono" maxlength="45" placeholder="Teléfono" value="<?= escapar($datos['telefono']) ?>" required>
                </label>
                <label><span>Ciudad</span>
                    <input type="text" name="ciudad" maxlength="45" placeholder="Ciudad" value="<?= escapar($datos['ciudad']) ?>" required>
                </label>
                <label><span>Correo electrónico</span>
                    <input type="email" name="correo" maxlength="45" placeholder="Correo electrónico" value="<?= escapar($datos['correo']) ?>" required>
                </label>
                <div class="acciones-formulario">
                    <a class="boton boton-secundario" href="index.php">Cancelar</a>
                    <button class="boton boton-principal" type="submit">Guardar</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
