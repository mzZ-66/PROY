<?php
    include "../DAO/operacionesContrato.php";
    include "../DAO/operacionesAlumno.php";
    include "../DAO/operacionesEmpresa.php";
    include "../DAO/operacionesSolicitudEmpleo.php";
    include "../Modelo/Contrato.php";
    include "enviarMail.php";

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $dni = $_POST["dni"];
    $tipoContrato = $_POST["tipoContrato"];
    $fechaContrato = date("Y-m-d");
    $solicitud = $_POST["solicitud"];

    try {
        $operacionesContrato = new operacionesContrato();

        // compruebo que el alumno no esté contratado
        $operacionesContrato->alumnoEnContrato($dni);

        // si no lo está lo creo y registro
        $nuevoContrato = new Contrato(null, $dni, $_SESSION['empresa']['cif'], $tipoContrato, $fechaContrato);
        $operacionesContrato->registrarContrato($nuevoContrato);

        // obtengo los datos del alumno
        $operacionesAlumno = new operacionesAlumno();
        $alumno = $operacionesAlumno->obtenerAlumnoPorDni($dni); // TODO: comprobar que esto funciona bien, ya que he cambiado el método por la reestrcturacion de los estudios
        // y actualizo su disponibilidad a ocupado
        $operacionesAlumno->actualizarDisponibilidad($dni, 0);

        // actualizo la empresa a empleadora
        $operacionesEmpresa = new operacionesEmpresa();
        $operacionesEmpresa->actualizarEmpleadora($_SESSION['empresa']['cif'], 1);

        // hago que la solicitud quede como inactiva
        $operacionesSolicitudEmpleo = new operacionesSolicitudEmpleo();
        $operacionesSolicitudEmpleo->actualizarActiva($solicitud, 0);

        // envio un email al alumno
        $mensajeEmail = "
            <p>¡Enhorabuena, " . $alumno['nombre'] . ": La empresa <b>" . $_SESSION['empresa']['nombre'] . "</b>, con CIF <b>" . $_SESSION['empresa']['cif'] . "</b> te ha contratado!</p>
            <p>Ponte en contacto con ellos mediante el email:</p>
            <p><b>" . $_SESSION['empresa']['email'] . "</b></p>
        ";
        enviarMail("Contrato en " . $_SESSION['empresa']['nombre'], $mensajeEmail, $alumno['email']);
        $mensaje = "Contrato registrado correctamente.";
        echo json_encode(['mensaje' => $mensaje]);
    } catch (Exception $e) {
        $error = $e->getMessage();
        echo json_encode(['error' => $error]);
    }
?>