<?php
require_once 'conexion.php';

// La eliminación solo se acepta mediante POST, no desde un enlace GET.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if ($id && $id > 0) {
    $consulta = $conexion->prepare('DELETE FROM PERSONA WHERE id = :id');
    $consulta->execute(['id' => $id]);
}

header('Location: index.php?estado=eliminado');
exit;
