<?php
    include "../DAO/operacionesEmpresa.php";

    $cif = $_POST["cif"];
    $clave = $_POST["clave"];
    $db = new operacionesEmpresa();

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    try {
        $db->estaDeBaja($cif);
        $db->borrarAvisoSiLoEsta($cif);
        $db->loginEmpresa($cif, $clave);
        echo json_encode(['mensaje' => 'Login correcto']);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
?>