<?php
    include_once("conexionDB.php");
    class operacionesContrato {
        private $conexion;
        public function __construct() {
            $conexion = new conexionDB();
            $this->conexion = $conexion->getConexion();
        }

        function registrarContrato($contrato) {
            $empleado = $contrato->getEmpleado();
            $empresa = $contrato->getEmpresa();
            $tipoContrato = $contrato->getTipoContrato();
            $fechaContrato = $contrato->getFechaContrato();

                $consulta = $this->conexion->prepare("INSERT INTO contrato (empleado, empresa, tipoContrato, fechaContrato) VALUES (?, ?, ?, ?)");
            $consulta->bind_param("siss", $empleado, $empresa, $tipoContrato, $fechaContrato);
            $consulta->execute();

            // asigno el id obtenido de la BD al objeto para que sea correcto
            $idAsignado = $this->conexion->insert_id;
            $contrato->setId($idAsignado);

            $consulta->close(); // importante cerrar la consulta, ya que se van a usar DAOs diferentes en el mismo controlador
        }
        
        function alumnoEnContrato($dni) {
            $consulta = $this->conexion->prepare("SELECT COUNT(*) FROM contrato WHERE empleado = ?");
            $consulta->bind_param("s", $dni);
            $consulta->execute();
            $resultado = $consulta->get_result();
            $fila = $resultado->fetch_assoc();
            $cantidadContratos = $fila['COUNT(*)'];
            $consulta->close();
            if ($cantidadContratos > 0) {
                throw new Exception("El alumno ya está contratado");
            } else {
                return false;
            }
        }

        function contratosPorEmpresa($cif) {
            $consulta = $this->conexion->prepare("SELECT * FROM contrato WHERE empresa = ?");
            $consulta->bind_param("s", $cif);
            $consulta->execute();
            $resultado = $consulta->get_result();
            $contratos = [];
            while ($fila = $resultado->fetch_assoc()) {
                $contratos[] = $fila;
            }
            $consulta->close();
            return $contratos;
        }
    }
?>