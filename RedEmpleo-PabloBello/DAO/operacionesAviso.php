<?php
    include_once("conexionDB.php");
    class operacionesAviso {
        private $conexion;
        public function __construct() {
            $conexion = new conexionDB();
            $this->conexion = $conexion->getConexion();
        }

        public function comprobarAvisoPorEmail($email) {
            $consulta = $this->conexion->prepare("SELECT * FROM aviso WHERE email = ?");
            $consulta->bind_param("s", $email);
            $consulta->execute();
            $resultado = $consulta->get_result();
            $consulta->close();
            if ($resultado->num_rows > 0) {
                return true;
            } else return false;
        }

        public function crearAviso($aviso) {
            $email = $aviso->getEmail();
            $fecha = $aviso->getFecha();

            $consulta = $this->conexion->prepare("INSERT INTO aviso (email, fecha) VALUES (?, ?)");
            $consulta->bind_param("ss", $email, $fecha);
            $consulta->execute();
            $consulta->close();
        }

        public function eliminarAviso($id) {
            $consulta = $this->conexion->prepare("DELETE FROM aviso WHERE id = ?");
            $consulta->bind_param("i", $id);
            $consulta->execute();
            $consulta->close();
        }

        public function comprobarAvisos() {
            $consulta = $this->conexion->prepare("SELECT * FROM aviso");
            $consulta->execute();
            $resultado = $consulta->get_result();
            $consulta->close();
        
            $ahora = date("Y-m-d");
            $emails = array();
            while ($aviso = $resultado->fetch_assoc()) {
                $fecha = $aviso['fecha'];
                $diferencia = strtotime($ahora) - strtotime($fecha);
                $dias = $diferencia / (60 * 60 * 24);
                if ($dias > 30) {
                    $this->eliminarAviso($aviso['id']);
                    $emails[] = $aviso['email'];
                }
            }
            return $emails;
        }
    }
?>