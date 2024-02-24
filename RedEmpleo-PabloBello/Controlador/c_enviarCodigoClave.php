<?php
include "enviarMail.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$data = json_decode(file_get_contents('php://input'), true);
$codigoEmail = $data['codigoEmail'];
$mensajeEmail = "
    <p>Tu código de cambio de clave es:</p>
    <p><b>" . $codigoEmail . "</b></p>
";
function enviarCodigoClave($mensajeEmail, $email) {
    try {
        enviarMail("Cambio de clave de RedEmpleo", $mensajeEmail, $email);
        echo json_encode(['mensaje' => 'Clave enviada']);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}
switch ($_SESSION['tipoUsuario']) {
    case 'alumno':
        enviarCodigoClave($mensajeEmail, $_SESSION['alumno']['email']);
        break;
    case 'empresa':
        enviarCodigoClave($mensajeEmail, $_SESSION['empresa']['email']);
        break;
    case 'tutor':
        enviarCodigoClave($mensajeEmail, $_SESSION['tutor']['email']);
        break;
    default:
        echo json_encode(['error' => 'Tipo de usuario no válido']);
}
?>
