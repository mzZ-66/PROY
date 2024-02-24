<?php
    include "../DAO/operacionesAlumno.php";

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $codigoEmailUsuario = $_POST['codigoEmailUsuario'];
    $codigoEmail = $_POST['codigoEmail'];
    $nuevaClave = $_POST['nuevaClave'];

    $db = new operacionesAlumno();
    if ($codigoEmailUsuario == $codigoEmail) {
        try {
            $db->cambiarClave($_SESSION['alumno']['dni'], $nuevaClave);
            echo json_encode(["mensaje" => "La clave ha sido cambiada"]);
        } catch (Exception $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
    } else {
        echo json_encode(["error" => "El código de verificación no coincide"]);
    }
?>