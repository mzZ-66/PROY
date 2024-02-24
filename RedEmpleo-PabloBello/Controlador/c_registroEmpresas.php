<?php
    include "../DAO/operacionesEmpresa.php";
    include "../Modelo/Empresa.php";
    include "enviarMail.php";

    $cif = $_POST["cif"];
    $clave = $_POST["clave"];
    $nombre = $_POST["nombreEmpresa"];
    $email = $_POST["email"];
    $ultimaPeticion = date("Y-m-d"); // lo establecemos ahora aunque no haya hecho ninguna petición (da igual ya que en 6 meses se mandará el mail igualmente)

    $db = new operacionesEmpresa();
    try {
        $nuevaEmpresa = new Empresa($cif, $clave, $nombre, $email, $ultimaPeticion, 0);

        $db->registrarEmpresa($nuevaEmpresa);
        $mensajeEmail = "
            <p>Te has registrado correctamente en RedEmpleo como empresa. Tu CIF es tu usuario:</p>
            <p><b>" . $cif . "</b></p>
            <p>Tu contraseña es:</p>
            <p><b>" . $clave . "</b></p>
        ";
        enviarMail("Registro en RedEmpleo", $mensajeEmail, $email);
        $mensaje = "Registro correcto";
        echo json_encode(['mensaje' => $mensaje]);
    } catch (Exception $e) {
        $error = "Esa empresa ya está registrada";
        echo json_encode(['error' => $error]);
    }
?>