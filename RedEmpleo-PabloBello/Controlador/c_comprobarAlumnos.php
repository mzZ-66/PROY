<?php
    include "../DAO/operacionesAlumno.php";
    include "../Modelo/Alumno.php";

    $dni = $_POST["dni"];
    $db = new operacionesAlumno();

    try {
        $datosAlumno = $db->comprobarDni($dni);
        $error = null;
    } catch (Exception $e) {
        $datosAlumno = null;
        $error = $e->getMessage();
    }

    echo json_encode(['datosAlumno' => $datosAlumno, 'error' => $error]);
?>