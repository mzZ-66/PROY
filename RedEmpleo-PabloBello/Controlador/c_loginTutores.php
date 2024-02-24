<?php
    include "../DAO/operacionesTutor.php";

    $dni = $_POST["dni"];
    $clave = $_POST["clave"];
    $db = new operacionesTutor();

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    try {
        $db->loginTutor($dni, $clave);
        echo json_encode(['mensaje' => 'Login correcto']);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
?>