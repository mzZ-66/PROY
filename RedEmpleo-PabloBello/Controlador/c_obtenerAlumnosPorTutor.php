<?php
include "../DAO/operacionesAlumno.php";
include "../DAO/operacionesFct.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

try {
    // obtengo los alumnos que pertencen al tutor
    $operacionesAlumno = new operacionesAlumno();
    $alumnos = $operacionesAlumno->obtenerAlumnosPorIdEstudios($_SESSION['tutor']['estudiosTutoria']); // TODO: comprobar ya que se ha cambiado el método por la reestructuracion de los estudios

    // compruebo si los alumnos ya están en una FCT
    $operacionesFct = new operacionesFct();
    $alumnosNoEncontrados = $operacionesFct->comprobarFctPorAlumno($alumnos);

    $error = null;
} catch (Exception $e) {
    $alumnos = null;
    $error = $e->getMessage();
}

echo json_encode(['campos' => $alumnosNoEncontrados, 'error' => $error]);
?>