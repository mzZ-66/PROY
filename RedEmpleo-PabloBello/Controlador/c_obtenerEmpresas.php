<?php
    include "../DAO/operacionesEmpresa.php";

    try {
        $operacionesEmpresa = new operacionesEmpresa();
        $empresas = $operacionesEmpresa->obtenerEmpresas();
        $mensaje = "Empresas encontradas.";
        echo json_encode(['campos' => $empresas]);
    } catch (Exception $e) {
        $error = $e->getMessage();
        echo json_encode(['error' => $error]);
    }
?>