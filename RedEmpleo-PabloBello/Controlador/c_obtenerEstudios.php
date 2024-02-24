<?php
include "../DAO/operacionesEstudios.php";

$db = new operacionesEstudios();

try {
    $estudios = $db->obtenerEstudios();
    $error = null;
} catch (Exception $e) {
    $estudios = null;
    $error = $e->getMessage();
}

echo json_encode(['campos' => $estudios, 'error' => $error]);
?>