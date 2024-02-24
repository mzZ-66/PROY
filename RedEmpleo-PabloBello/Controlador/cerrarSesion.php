<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    unset($_SESSION['alumno']);
    unset($_SESSION['empresa']);
    unset($_SESSION['tutor']);
    unset($_SESSION['tipoUsuario']);
    session_destroy();
    echo json_encode(['mensaje' => 'Sesión cerrada']);
?>