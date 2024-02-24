<?php
    include "../DAO/operacionesAlumno.php";
    
    $dni = $_POST["dniSelect"];

    try {
        $operacionesAlumno = new operacionesAlumno();
        $alumno = $operacionesAlumno->obtenerAlumnoPorDni($dni);
        echo json_encode(['alumno' => $alumno]);
    } catch (Exception $e) {
        $error = $e->getMessage();
        echo json_encode(['error' => $error]);
    }
?>