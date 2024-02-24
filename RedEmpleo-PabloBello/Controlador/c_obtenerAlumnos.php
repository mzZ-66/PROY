<?php
    include "../DAO/operacionesAlumno.php";

    try {
        $operacionesAlumno = new operacionesAlumno();
        $alumnos = $operacionesAlumno->obtenerAlumnos();
        $mensaje = "Alumno encontrado.";
        echo json_encode(['campos' => $alumnos]);
    } catch (Exception $e) {
        $error = $e->getMessage();
        echo json_encode(['error' => $error]);
    }
?>