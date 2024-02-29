<?php
    include "../DAO/operacionesAdmin.php";
    include "../DAO/operacionesAviso.php";
    include "../DAO/operacionesAlumno.php";
    include "../DAO/operacionesEmpresa.php";
    include "../Modelo/Aviso.php";
    include "enviarMail.php";

    $dni = $_POST["dni"];
    $clave = $_POST["clave"];

    $ahora = date("Y-m-d");
    $mensajeAvisoInactividad = null;
    $operacionesAlumno = new operacionesAlumno();
    $operacionesAviso = new operacionesAviso();

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // comprobaciones de acceso de los alumnos
    $alumnosInactivos = $operacionesAlumno->obtenerAlumnosInactivos();
    if (!empty($alumnosInactivos)) {
        $mensajeEmail = "
            <p>Tu cuenta ha estado sin acceder a RedEmpleo durante 1 año.</p>
            <p><b>Si no accedes a la plataforma en los próximos 30 días, tu cuenta será dada de baja.</b></p><br>
            <p>- Equipo de RedEmpleo</p>
        ";
        foreach ($alumnosInactivos as $alumno) {
            if ($operacionesAlumno->isActivo($alumno['dni'])) {
                if (!$operacionesAviso->comprobarAvisoPorEmail($alumno['email'])) {
                    enviarMail("AVISO: Cuenta de alumno inactiva", $mensajeEmail, $alumno['email']);
                    $nuevoAviso = new Aviso(null, $alumno['email'], $ahora);
                    $operacionesAviso->crearAviso($nuevoAviso);
                    $mensajeAvisoInactividad = "Se ha enviado un aviso a los alumnos inactivos.";
                }
            }
        }
    }

    // comprobaciones de peticiones de las empresas
    $operacionesEmpresa = new operacionesEmpresa();
    $empresasInactivas = $operacionesEmpresa->obtenerEmpresasInactivas();
    if (!empty($empresasInactivas)) {
        $mensajeEmail = "
            <p>Tu cuenta no ha hecho ninguna petición durante 6 meses.</p>
            <p><b>Si no accedes a la plataforma en los próximos 30 días, tu cuenta será dada de baja.</b></p><br>
            <p>- Equipo de RedEmpleo</p>
        ";
        foreach ($empresasInactivas as $empresa) {
            if ($operacionesEmpresa->isActivo($empresa['cif'])) {
                if (!$operacionesAviso->comprobarAvisoPorEmail($empresa['email'])) {
                    enviarMail("AVISO: Cuenta de empresa inactiva", $mensajeEmail, $empresa['email']);
                    $nuevoAviso = new Aviso(null, $empresa['email'], $ahora);
                    $operacionesAviso->crearAviso($nuevoAviso);
                    $mensajeAvisoInactividad = "Se ha enviado un aviso a las empresas inactivos.";
                }
            }
        }
    }

    // compruebo si han pasado 30 días desde que se envió el aviso, y si es así se dan de baja
    $emailDeUsuariosADarDeBaja = $operacionesAviso->comprobarAvisos();
    if (!empty($emailDeUsuariosADarDeBaja)) {
        foreach ($emailDeUsuariosADarDeBaja as $email) {
            $operacionesAlumno->darDeBajaAlumnoPorEmail($email);
            $operacionesEmpresa->darDeBajaEmpresaPorEmail($email);
        }
        $mensajeAvisoInactividad = "Se han dado de baja a los usuarios inactivos.";
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