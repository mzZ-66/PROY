<?php
    include "../DAO/operacionesAdmin.php";
    include "../DAO/operacionesAlumno.php";
    include "../DAO/operacionesEmpresa.php";
    include "enviarMail.php";

    $dni = $_POST["dni"];
    $clave = $_POST["clave"];

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // TODO: gestionar la baja de cuentas inactivas
    // comprobaciones de acceso y peticiones de los alumnos y empresas
    $mensajeAvisoInactividad = null;

    $operacionesAlumno = new operacionesAlumno();
    $alumnosInactivos = $operacionesAlumno->obtenerAlumnosInactivos();
    if (!empty($alumnosInactivos)) {
        $mensajeEmail = "
            <p>Tu cuenta ha estado sin acceder a RedEmpleo durante 1 año.</p>
            <p><b>Si no accedes a la plataforma en los próximos 30 días, tu cuenta será dada de baja.</b></p><br>
            <p>- Equipo de RedEmpleo</p>
        ";
        foreach ($alumnosInactivos as $alumno) {
            enviarMail("AVISO: Cuenta de alumno inactiva", $mensajeEmail, $alumno['email']);
            $mensajeAvisoInactividad = "Se ha enviado un aviso a los alumnos inactivos.";
        }
    }

    $operacionesEmpresa = new operacionesEmpresa();
    $empresasInactivas = $operacionesEmpresa->obtenerEmpresasInactivas();
    if (!empty($empresasInactivas)) {
        $mensajeEmail = "
            <p>Tu cuenta no ha hecho ninguna petición durante 6 meses.</p>
            <p><b>Si no accedes a la plataforma en los próximos 30 días, tu cuenta será dada de baja.</b></p><br>
            <p>- Equipo de RedEmpleo</p>
        ";
        foreach ($empresasInactivas as $empresa) {
            enviarMail("AVISO: Cuenta de empresa inactiva", $mensajeEmail, $empresa['email']);
            $mensajeAvisoInactividad = "Se ha enviado un aviso a las empresas inactivos.";
        }
    }

    // login del admin
    try {
        $db = new operacionesAdmin();
        $db->loginAdmin($dni, $clave);
        echo json_encode(['mensaje' => 'Login correcto', 'avisoInactividad' => $mensajeAvisoInactividad]);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
?>