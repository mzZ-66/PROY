<?php
    include "../DAO/operacionesAlumno.php";
    include "../Modelo/Alumno.php";
    include "../Modelo/Estudios.php";
    include "enviarMail.php";

    $dni = $_POST["dni"];
    $clave = $_POST["clave"];
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $email = $_POST["email"];
    $estudiosCentro = $_POST["estudiosSelect"];
    $estudiosExternos = $_POST["estudiosExternos"];
    $ultimoAcceso = date("Y-m-d");
    $disponibilidad = $_POST["disponibilidad"];

    $db = new operacionesAlumno();
    try {
        $nuevoAlumno = new Alumno($dni, $clave, $nombre, $apellidos, $email, $disponibilidad, $ultimoAcceso, $estudiosCentro, $estudiosExternos);

        $db->registrarAlumno($nuevoAlumno);
        $mensajeEmail = "
            <p>Te has registrado correctamente en RedEmpleo como alumno. Tu DNI es tu usuario:</p>
            <p><b>" . $dni . "</b></p>
            <p>Tu contraseña es:</p>
            <p><b>" . $clave . "</b></p>
        ";
        enviarMail("Registro en RedEmpleo", $mensajeEmail, $email);
        $mensaje = "Registro correcto";
    } catch (Exception $e) {
        $mensaje = $e->getMessage();
    }

    echo json_encode(['mensaje' => $mensaje]);
?>