<?php
    include_once("conexionDB.php");
    class operacionesTutor {
        private $conexion;
        public function __construct() {
            $conexion = new conexionDB();
            $this->conexion = $conexion->getConexion();
        }

        function loginTutor($dni, $clave) {
            $consulta = $this->conexion->prepare("SELECT * FROM tutor WHERE dni = ?;");
            $consulta->bind_param("s", $dni);
            $consulta->execute();
            $resultado = $consulta->get_result();
            if ($resultado->num_rows == 0) {
                throw new Exception("El DNI del tutor no está registrado en RedEmpleo");
            }
            $tutor = $resultado->fetch_assoc();
            if (password_verify($clave, $tutor['clave'])) {
                // cuando se loguea, guardo sus datos en la sesión
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['tutor'] = [
                    'dni' => $tutor['dni'],
                    'clave' => $tutor['clave'],
                    'nombre' => $tutor['nombre'],
                    'apellidos' => $tutor['apellidos'],
                    'email' => $tutor['email'],
                    'estudiosTutoria' => $tutor['estudiosTutoria']
                ];
                $_SESSION['tipoUsuario'] = "tutor";
                return $_SESSION['tutor'];
            } else {
                throw new Exception("La contraseña introducida es incorrecta.");
            }
        }

        function cambiarClave($dni, $nuevaClave) {
            $nuevaClaveHash = password_hash($nuevaClave, PASSWORD_DEFAULT);
        
            $consulta = $this->conexion->prepare("UPDATE tutor SET clave = ? WHERE dni = ?;");
            $consulta->bind_param("ss", $nuevaClaveHash, $dni);
            if (!$consulta->execute()) {
                throw new Exception("Error al cambiar la clave: " . $this->conexion->error);
            }
        }
    }
?>