<?php
    include "../DAO/operacionesAlumno.php";

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $estudiosExternos = $_POST['estudiosExternos'];
    $db = new operacionesAlumno();
    try {
        $db->actualizarEstudiosExternos($_SESSION['alumno']['dni'], $estudiosExternos);
        echo json_encode(['mensaje' => 'Estudios externos actualizados correctamente.']);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
?>