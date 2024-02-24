<?php
    include "../DAO/operacionesAlumno.php";
    
    $idEstudios = $_POST["estudiosSelect"];

    try {
        $operacionesAlumno = new operacionesAlumno();
        $alumnos = $operacionesAlumno->obtenerAlumnosPorIdEstudios($idEstudios);
        echo json_encode(['alumnos' => $alumnos]);
    } catch (Exception $e) {
        $error = $e->getMessage();
        echo json_encode(['error' => $error]);
    }
?>