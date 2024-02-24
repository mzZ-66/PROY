<?php
include "../DAO/operacionesSolicitudFct.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$idEstudiosTutoria = $_SESSION['tutor']['estudiosTutoria'];

$db = new operacionesSolicitudFct();
try {
    $solicitudesFct = $db->obtenerSolicitudesFctPorId($idEstudiosTutoria);
    $error = null;
} catch (Exception $e) {
    $solicitudesFct = null;
    $error = $e->getMessage();
}

echo json_encode(['campos' => $solicitudesFct, 'error' => $error]);
?>