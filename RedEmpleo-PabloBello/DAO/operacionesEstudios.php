<?php
    include_once("conexionDB.php");
    class operacionesEstudios {
        private $conexion;
        public function __construct() {
            $conexion = new conexionDB();
            $this->conexion = $conexion->getConexion();
        }

        public function obtenerEstudios() {
            $consulta = $this->conexion->prepare("SELECT id, nombre FROM estudios;");
            $consulta->execute();
            $resultado = $consulta->get_result();
            $estudios = [];
            while ($fila = $resultado->fetch_assoc()) {
                $estudios[] = $fila;
            }
            return $estudios;
        }

        public function obtenerEstudiosPorId($id) {
            $consulta = $this->conexion->prepare("SELECT nombre FROM estudios WHERE id = ?;");
            $consulta->bind_param("i", $id);
            $consulta->execute();
            $resultado = $consulta->get_result();
            $estudios = $resultado->fetch_assoc();
            $consulta->close();
            return $estudios["nombre"];
        }

        // function registrarEstudios($nuevosEstudios) {
        //     $estudiosCentro = $nuevosEstudios->getEstudiosCentro();
        //     $estudiosExternos = $nuevosEstudios->getEstudiosExternos();

        //     $consulta = $this->conexion->prepare("INSERT INTO estudios (estudiosCentro, estudiosExternos) VALUES (?, ?)");
        //     $consulta->bind_param("ss", $estudiosCentro, $estudiosExternos);
        //     $consulta->execute();
        //     return $this->conexion->insert_id;
        // }
    }
?>