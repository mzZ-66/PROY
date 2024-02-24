<?php
include "../DAO/operacionesSolicitudEmpleo.php";

$db = new operacionesSolicitudEmpleo();

try {
    $solicitudes = $db->obtenerSolicitudesEmpleo();
    $error = null;
} catch (Exception $e) {
    $solicitudes = null;
    $error = $e->getMessage();
}

echo json_encode(['campos' => $solicitudes, 'error' => $error]);
?>