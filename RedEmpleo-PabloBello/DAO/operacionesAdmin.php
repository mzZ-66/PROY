<?php
    include_once("conexionDB.php");
    class operacionesAdmin {
        private $conexion;
        public function __construct() {
            $conexion = new conexionDB();
            $this->conexion = $conexion->getConexion();
        }
        
        function loginAdmin($dni, $clave) {
            $consulta = $this->conexion->prepare("SELECT * FROM admin WHERE dni = ?;");
            $consulta->bind_param("s", $dni);
            $consulta->execute();
            $resultado = $consulta->get_result();
            if ($resultado->num_rows == 0) {
                throw new Exception("El DNI del admin no está registrado en RedEmpleo");
            }
            $admin = $resultado->fetch_assoc();
            if (password_verify($clave, $admin['clave'])) {
                // guardo sus datos en la sesión
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['admin'] = [
                    'dni' => $admin['dni'],
                    'clave' => $admin['clave'],
                    'nombre' => $admin['nombre'],
                    'apellidos' => $admin['apellidos'],
                    'email' => $admin['email']
                ];
                $_SESSION['tipoUsuario'] = "admin";
                return $_SESSION['admin'];
            } else {
                throw new Exception("La contraseña introducida es incorrecta.");
            }
        }
    }
?>