<?php
    include "../DAO/operacionesAlumno.php";
    include "../DAO/operacionesAlumno_estudios.php";
    include "../Modelo/Alumno.php";
    include "../Modelo/Alumno_estudios.php";
    include "enviarMail.php";

    $dni = $_POST["dni"];
    $clave = $_POST["clave"];
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $email = $_POST["email"];
    $alumno_estudios = $_POST['estudiosSelect'];
    $estudiosExternos = $_POST["estudiosExternos"];
    $ultimoAcceso = date("Y-m-d");
    $disponibilidad = $_POST["disponibilidad"];

    try {
        $operacionesAlumno = new operacionesAlumno();
        $nuevoAlumno = new Alumno($dni, $clave, $nombre, $apellidos, $email, $disponibilidad, $ultimoAcceso, $estudiosExternos, 1);
        $operacionesAlumno->registrarAlumno($nuevoAlumno);

        $operacionesAlumno_estudios = new operacionesAlumno_estudios();
        foreach ($alumno_estudios as $estudio) {
            $nuevoAlumno_estudios = new Alumno_estudios(null, $dni, $estudio);
            $operacionesAlumno_estudios->registrarAlumno_estudios($nuevoAlumno_estudios);
        }

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