<?php
    include "../DAO/operacionesEmpresa.php";
    
    $idEstudios = $_POST["estudiosSelect"];

    try {
        $operacionesEmpresa = new operacionesEmpresa();
        $empresas = $operacionesEmpresa->obtenerEmpresasPorIdEstudios($idEstudios);
        echo json_encode(['empresas' => $empresas]);
    } catch (Exception $e) {
        $error = $e->getMessage();
        echo json_encode(['error' => $error]);
    }
?>