<?php
    include "../DAO/operacionesContrato.php";

    $cif = $_POST["cifSelect"];

    try {
        $operacionesContrato = new operacionesContrato();
        $contratos = $operacionesContrato->contratosPorEmpresa($cif);
        echo json_encode(['contratos' => $contratos]);
    } catch (Exception $e) {
        $error = $e->getMessage();
        echo json_encode(['error' => $error]);
    }
?>