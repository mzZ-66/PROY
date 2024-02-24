<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$tipoUsuario = isset($_SESSION['tipoUsuario']) ? $_SESSION['tipoUsuario'] : '';

if ($tipoUsuario === '') {
    echo json_encode(['error' => 'La variable de sesión está vacía.']);
} else {
    echo json_encode(['tipoUsuario' => $tipoUsuario]);
}
?>