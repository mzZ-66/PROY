<?php
    include "../DAO/operacionesSolicitudEmpleo.php";
    include "../DAO/operacionesEmpresa.php";
    include "../DAO/operacionesAlumno.php";
    include "../DAO/operacionesEstudios.php";
    include "../Modelo/SolicitudEmpleo.php";
    include "enviarMail.php";

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    $perfilProfesional = $_POST["estudiosSelect"];
    $experiencia = $_POST["experiencia"];
    $posibilidadViajar = $_POST["posibilidadViajar"];
    $residenciaFavorita = $_POST["residenciaFavorita"];
    $descripcion = $_POST["descripcion"];

    try {
        $operacionesSolicitudEmpleo = new operacionesSolicitudEmpleo();

        // le asigno null al id porque es autoincremental y se lo pongo cuando lo inserto en la BD
        $nuevaSolicitud = new SolicitudEmpleo(null, $_SESSION["empresa"]['cif'], $perfilProfesional, $experiencia, $posibilidadViajar, $residenciaFavorita, $descripcion, 1);
        $operacionesSolicitudEmpleo->registrarSolicitudEmpleo($nuevaSolicitud);

        // actualizo la ultima peticion de la empresa
        $operacionesEmpresa = new operacionesEmpresa();
        $operacionesEmpresa->actualizarUltimaPeticion($_SESSION["empresa"]['cif']);

        // obtengo el nombre de los estudios de la solicitud con su id
        $operacionesEstudios = new operacionesEstudios();
        $estudios = $operacionesEstudios->obtenerEstudiosPorId($perfilProfesional);

        // obtengo los alumnos que cumplan con los requisitos de la solicitud
        $operacionesAlumno = new operacionesAlumno();
        $alumnos = $operacionesAlumno->obtenerAlumnosDisponibles($perfilProfesional, 1);

        // envio los email
        $mensajeEmail = "
            <h1>Has recibido una solicitud de empleo de " . $_SESSION['empresa']['nombre'] . ":</h1>
            <h3>Requisitos del puesto:</h3>
            <p>- Perfil profesional: <b>" . $estudios . "</b></p>
            <p>- Experiencia: <b>" . $experiencia . "</b></p>
            <p>- Lugar de residencia preferido: <b>" . $residenciaFavorita . "</b></p><br>
            <h3>Descripción:</h3>
            <p>" . $descripcion . "</p><br>
            <p>Para más información, por favor contacta mediante el siguiente email:</p>
            <p><b>" . $_SESSION['empresa']['email'] . "</b></p>
        ";
        foreach ($alumnos as $alumno) {
            enviarMail("Nueva solicitud de empleo", $mensajeEmail, $alumno['email']);
        }
        
        $mensaje = "Solicitud de empleo registrada correctamente";
    } catch (Exception $e) {
        $mensaje = $e->getMessage();
    }

    echo json_encode(['mensaje' => $mensaje]);
?>