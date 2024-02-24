<?php
    include "../DAO/operacionesFct.php";
    include "../DAO/operacionesSolicitudFct.php";
    include "../Modelo/Fct.php";


    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $dni = $_POST['dniSelect'];
    $cif = $_POST['cifSelect'];
    $modalidadFct = $_POST['fctSelect'];

    try {
        // aqui me encargo comprobar que existe la solicitud FCT de dicha modalidad, además de ajustar las plazas disponibles
        $operacionesSolicitudFct = new operacionesSolicitudFct();
        $operacionesSolicitudFct->restarAlumnoSolicitudFct($cif, $modalidadFct, $_SESSION['tutor']['estudiosTutoria']);

        $nuevaFct = new Fct(null, $dni, $cif, $modalidadFct);

        $operacionesFct = new operacionesFct();
        $operacionesFct->registrarFct($nuevaFct);

        $mensaje = "FCT asignada correctamente.";
        echo json_encode(['mensaje' => $mensaje]);
    } catch (Exception $e) {
        $error = $e->getMessage();
        echo json_encode(['error' => $error]);
    }
?>