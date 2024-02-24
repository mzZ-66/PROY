<?php
    include "../DAO/operacionesEmpresa.php";
    
    $cif = $_POST["cifSelect"];

    try {
        $operacionesEmpresa = new operacionesEmpresa();
        $empresa = $operacionesEmpresa->obtenerEmpresaPorCif($cif);
        echo json_encode(['empresa' => $empresa]);
    } catch (Exception $e) {
        $error = $e->getMessage();
        echo json_encode(['error' => $error]);
    }
?>