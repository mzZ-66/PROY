<?php
    include "../DAO/operacionesAlumno.php";
    
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $db = new operacionesAlumno();
    try {
        $estudiosExternos = $db->obtenerEstudioExternos($_SESSION['alumno']['dni']);
        echo json_encode(['estudiosExternos' => $estudiosExternos]);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
?>