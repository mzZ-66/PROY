<?php
    include "../DAO/operacionesAlumno.php";
    include "../DAO/operacionesAlumno_estudios.php";
    include "../Modelo/Alumno_estudios.php";

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $alumno_estudios = $_POST['estudiosSelect'];
    $estudiosExternos = $_POST['estudiosExternos'];

    try {
        // actualizo los estudios internos
        $operacionesAlumno_estudios = new operacionesAlumno_estudios();
        foreach ($alumno_estudios as $estudio) {
            $nuevoAlumno_estudios = new Alumno_estudios(null, $_SESSION['alumno']['dni'], $estudio);
            $operacionesAlumno_estudios->registrarAlumno_estudios($nuevoAlumno_estudios);
        }

        // y los externos
        $operacionesAlumno = new operacionesAlumno();
        $operacionesAlumno->actualizarEstudiosExternos($_SESSION['alumno']['dni'], $estudiosExternos);
        echo json_encode(['mensaje' => 'Estudios externos actualizados correctamente.']);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
?>