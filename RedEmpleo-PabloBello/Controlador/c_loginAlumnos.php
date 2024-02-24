<?php
    include "../DAO/operacionesAlumno.php";

    $dni = $_POST["dni"];
    $clave = $_POST["clave"];
    $db = new operacionesAlumno();

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    try {
        $db->loginAlumno($dni, $clave);
        echo json_encode(['mensaje' => 'Login correcto']);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
?>