<?php
    include "../DAO/operacionesAdmin.php";

    $dni = $_POST["dni"];
    $clave = $_POST["clave"];
    $db = new operacionesAdmin();

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    try {
        $db->loginAdmin($dni, $clave);
        echo json_encode(['mensaje' => 'Login correcto']);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
?>