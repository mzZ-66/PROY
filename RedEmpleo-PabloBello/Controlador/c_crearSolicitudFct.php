<?php
    include "../DAO/operacionesSolicitudFct.php";
    include "../DAO/operacionesEmpresa.php";
    include "../Modelo/SolicitudFct.php";

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $nAlumnosPorEstudios = $_POST['numAlumnos'];
    $modalidadFct = $_POST['fctSelect'];

    // convierto los datos a int
    foreach ($nAlumnosPorEstudios as $key => $value) {
        $nAlumnosPorEstudios[$key] = intval($value);
    }

    // serializo el array asociativo para guardarlo de manera correcta en la BD. en caso de que se necesite mostrar de nuevo, se usará unserialize
    $nAlumnosPorEstudiosSerializado = serialize($nAlumnosPorEstudios);

    try {
        $nuevaSolicitudFct = new SolicitudFct(null, $_SESSION['empresa']['cif'], $nAlumnosPorEstudiosSerializado, $modalidadFct, $nAlumnosPorEstudiosSerializado); // establezco el restante igual que el original, ya que al principio son lo mismo
        $operacionesSolicitudFct= new operacionesSolicitudFct();
        $operacionesSolicitudFct->registrarSolicitudFct($nuevaSolicitudFct);

        // actualizo la ultima peticion de la empresa
        $operacionesEmpresa = new operacionesEmpresa();
        $operacionesEmpresa->actualizarUltimaPeticion($_SESSION["empresa"]['cif']);

        $mensaje = "Solicitud FCT registrada correctamente.";
        echo json_encode(['mensaje' => $mensaje]);
    } catch (Exception $e) {
        $error = $e->getMessage();
        echo json_encode(['error' => $error]);
    }
?>