<?php
    include "../DAO/operacionesAlumno.php";
    
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $dniAlumno = $_SESSION['alumno']['dni'];
    $dispNueva = $_POST['disponibilidad'];

    $operacionesAlumno = new operacionesAlumno();

    try {
        $operacionesAlumno->actualizarDisponibilidad($dniAlumno, $dispNueva);
        echo json_encode(['mensaje' => 'Disponibilidad actualizada correctamente']);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
?>